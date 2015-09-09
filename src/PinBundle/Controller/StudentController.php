<?php
namespace PinBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use PinBundle\Entity\Entry;


/**
 * @Route("/student")
 */
class StudentController extends Controller
{
	/**
	 * @Route("/entry", name="student_entries")
	 * @Method("GET")
	 * @Template()
	 */
	public function entriesAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$entryRepo = $em->getRepository('PinBundle:Entry');
		$user = $this->getUser();

		$semesters = [];
		$enteredCourseIds = [];

		foreach ($entryRepo->getEntriesByStudent($user) as $entry) {
			if ($entry->getStatus() === Entry::STATUS_CANCELLED) {
				continue;
			}

			$course = $entry->getCourse();
			$enteredCourseIds[] = $course->getId();
			$semester = $user->isRegular() ? $course->getSemesterRegular() : $course->getSemesterPartTime();

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

	/**
	 * @Route("/profile", name="student_profile")
	 * @Method({"GET", "POST"})
	 * @Template()
	 */
	public function profileAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');

		return [
			'courses' => $courseRepo->findAll(),
		];
	}
}
