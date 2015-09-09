<?php
namespace PinBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PinBundle\Entity\Course;
use PinBundle\Entity\Entry;
use PinBundle\Form\CourseType;


/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
	private function isTokenValid(Request $request) {
		return $this->get('form.csrf_provider')->isCsrfTokenValid('admin', $request->request->get('_token'));
	}

	/**
	 * @Route("/course", name="admin_courses")
	 * @Method("GET")
	 * @Template()
	 */
	public function coursesAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$userRepo = $em->getRepository('PinBundle:User');

		return [
			'courses' => $courseRepo->findAll(),
			'users' => $userRepo->findAll(),
		];
	}

	/**
	 * @Route("/course/new", name="admin_course_new")
	 * @Method({"GET", "POST"})
	 * @Template()
	 */
	public function courseNewAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');

		if ($request->getMethod() === 'POST') {
//			dump($request->request->all());
//			exit;
//			dump($this->generateUrl('admin_courses'));
//			exit;
			$course = new Course();
			$form = $this->createForm(new CourseType(), $course);
			$form->bind($request);

			if ($form->isValid()) {
				$em->persist($course);
				$em->flush();

				return $this->redirect($this->generateUrl('admin_courses'));
			} else {
				return [
					'errors' => $form->getErrors(),
				];
			}
		}

		$course = new Course();
		$form = $this->createForm(new CourseType(), $course);

		return [
			'form' => $form->createView(),
		];
	}

	/**
	 * @Route("/course/{courseId}/edit", name="admin_course_edit")
	 * @Method({"GET", "POST"})
	 * @Template("PinBundle:Admin:courseNew.html.twig")
	 */
	public function courseEditAction(Request $request, $courseId)
	{
		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');

		$course = $courseRepo->find($courseId);
		if (!$course) {
			throw $this->createNotFoundException();
		}

		if ($request->getMethod() === 'POST') {
			$form = $this->createForm(new CourseType(), $course);
			$form->bind($request);

			if ($form->isValid()) {
				$em->persist($course);
				$em->flush();

				return $this->redirect($this->generateUrl('admin_courses'));
			} else {
				return [
					'errors' => $form->getErrors(),
				];
			}
		}

		$form = $this->createForm(new CourseType(), $course);

		return [
			'form' => $form->createView(),
			'course' => $course,
			'edit' => true,
		];
	}

	/**
	 * @Route("/course/{courseId}/delete", name="admin_course_delete")
	 * @Method("POST")
	 */
	public function courseDeleteAction(Request $request, $courseId)
	{
		if (!$this->isTokenValid($request)) {
			throw $this->createNotFoundException();
		}

		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');

		$course = $courseRepo->find($courseId);
		if (!$course) {
			throw $this->createNotFoundException();
		}

		$em->remove($course);
		$em->flush();

		return $this->redirect($this->generateUrl('admin_courses'));
	}

	/**
	 * @Route("/student", name="admin_students")
	 * @Method("GET")
	 * @Template()
	 */
	public function studentsAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$userRepo = $em->getRepository('PinBundle:User');

		return [
			'students' => $userRepo->getStudents(),
		];
	}

	/**
	 * @Route("/student/{studentId}", name="admin_student")
	 * @Method("GET")
	 * @Template()
	 */
	public function studentAction(Request $request, $studentId)
	{
		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$entryRepo = $em->getRepository('PinBundle:Entry');
		$userRepo = $em->getRepository('PinBundle:User');

		$user = $userRepo->find($studentId);
		if (!$user) {
			$this->createNotFoundException();
		}

		$semesters = [];
		$enteredCourseIds = [];

		foreach ($entryRepo->getEntriesByStudent($user) as $entry) {
			if ($entry->getStatus() === Entry::STATUS_CANCELLED) {
				continue;
			}

			$course = $entry->getCourse();
			$enteredCourseIds[] = $course->getId();
			if ($user->isRegular()) {
				$semester = $course->getSemesterRegular();
			} else {
				$semester = $course->getSemesterPartTime();
			}

			if (empty($semesters[$semester])) {
				$semesters[$semester] = [];
			}

			$semesters[$semester][] = $entry;
		}

		return [
			'student' => $user,
			'courses' => $courseRepo->getAllExcludingByIds($enteredCourseIds),
			'semesters' => $semesters,
		];
	}
}
