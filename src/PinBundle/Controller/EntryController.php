<?php
namespace PinBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use PinBundle\Entity\Course;
use PinBundle\Entity\Entry;
use PinBundle\Entity\User;


/**
 * @Route("/entry")
 */
class EntryController extends Controller
{
	private function isTokenValid(Request $request) {
		return $this->get('form.csrf_provider')->isCsrfTokenValid('entry', $request->request->get('_token'));
	}

	/**
	 * @Route("/{studentId}/{courseId}/request", name="entry_request")
	 * @Method("POST")
	 */
	public function entryRequestAction(Request $request, $studentId, $courseId)
	{
		if (!$this->isTokenValid($request)) {
			throw $this->createNotFoundException();
		}

		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$entryRepo = $em->getRepository('PinBundle:Entry');
		$userRepo = $em->getRepository('PinBundle:User');

		$user = $userRepo->find($studentId);
		if (!$user) {
			throw $this->createNotFoundException();
		}

		$course = $courseRepo->find($courseId);
		if (!$course) {
			throw $this->createNotFoundException();
		}

		$entry = $entryRepo->findOneBy([
			'user' => $user,
			'course' => $course,
		]);

		if (!$entry) {
			$entry = new Entry();
			$entry->setUser($user);
			$entry->setCourse($course);
		}

		$entry->setStatus(Entry::STATUS_REQUESTED);

		$em->persist($entry);
		$em->flush();

		if ($this->getUser()->hasRole('ROLE_ADMIN')) {
			return $this->redirect($this->generateUrl('admin_student', [
				'studentId' => $user->getId(),
			]));
		} else {
			return $this->redirect($this->generateUrl('student_entries'));
		}
	}

	/**
	 * @Route("/{studentId}/{courseId}/cancel", name="entry_cancel")
	 * @Method("POST")
	 */
	public function entryCancelAction(Request $request, $studentId, $courseId)
	{
		if (!$this->isTokenValid($request)) {
			throw $this->createNotFoundException();
		}

		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$entryRepo = $em->getRepository('PinBundle:Entry');
		$userRepo = $em->getRepository('PinBundle:User');

		$user = $userRepo->find($studentId);
		if (!$user) {
			throw $this->createNotFoundException();
		}

		$course = $courseRepo->find($courseId);
		if (!$course) {
			throw $this->createNotFoundException();
		}

		$entry = $entryRepo->findOneBy([
			'user' => $user,
			'course' => $course,
		]);

		if (!$entry) {
			throw $this->createNotFoundException();
		}

		$entry->setStatus(Entry::STATUS_CANCELLED);

		$em->persist($entry);
		$em->flush();

		if ($this->getUser()->hasRole('ROLE_ADMIN')) {
			return $this->redirect($this->generateUrl('admin_student', [
				'studentId' => $user->getId(),
			]));
		} else {
			return $this->redirect($this->generateUrl('student_entries'));
		}
	}

	/**
	 * @Route("/{studentId}/{courseId}/approve", name="entry_approve")
	 * @Method("POST")
	 */
	public function entryApproveAction(Request $request, $studentId, $courseId)
	{
		if (!$this->isTokenValid($request)) {
			throw $this->createNotFoundException();
		}

		if (!$this->getUser()->hasRole('ROLE_ADMIN')) {
			throw $this->createNotFoundException();
		}

		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$entryRepo = $em->getRepository('PinBundle:Entry');
		$userRepo = $em->getRepository('PinBundle:User');

		$user = $userRepo->find($studentId);
		if (!$user) {
			throw $this->createNotFoundException();
		}

		$course = $courseRepo->find($courseId);
		if (!$course) {
			throw $this->createNotFoundException();
		}

		$entry = $entryRepo->findOneBy([
			'user' => $user,
			'course' => $course,
		]);

		if ($entry && $entry->isPassed()) {
			throw $this->createNotFoundException();
		}

		if (!$entry) {
			$entry = new Entry();
			$entry->setUser($user);
			$entry->setCourse($course);
		}

		$entry->setStatus(Entry::STATUS_APPROVED);

		$em->persist($entry);
		$em->flush();

		return $this->redirect($this->generateUrl('admin_student', [
			'studentId' => $user->getId(),
		]));
	}

	/**
	 * @Route("/{studentId}/{courseId}/pass", name="entry_pass")
	 * @Method("POST")
	 */
	public function entryPassAction(Request $request, $studentId, $courseId)
	{
		if (!$this->isTokenValid($request)) {
			throw $this->createNotFoundException();
		}

		if (!$this->getUser()->hasRole('ROLE_ADMIN')) {
			throw $this->createNotFoundException();
		}

		$em = $this->getDoctrine()->getManager();
		$courseRepo = $em->getRepository('PinBundle:Course');
		$entryRepo = $em->getRepository('PinBundle:Entry');
		$userRepo = $em->getRepository('PinBundle:User');

		$user = $userRepo->find($studentId);
		if (!$user) {
			throw $this->createNotFoundException();
		}

		$course = $courseRepo->find($courseId);
		if (!$course) {
			throw $this->createNotFoundException();
		}

		$entry = $entryRepo->findOneBy([
			'user' => $user,
			'course' => $course,
		]);

		if (!$entry) {
			throw $this->createNotFoundException();
		}

		$entry->setStatus(Entry::STATUS_PASSED);

		$em->persist($entry);
		$em->flush();

		return $this->redirect($this->generateUrl('admin_student', [
			'studentId' => $user->getId(),
		]));
	}
}
