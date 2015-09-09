<?php
namespace PinBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 * @Template()
	 */
	public function indexAction(Request $request)
	{
		if ($this->getUser()->hasRole('ROLE_ADMIN')) {
			return $this->redirect($this->generateUrl('admin_courses'));
		}

		return $this->redirect($this->generateUrl('student_entries'));
	}
}
