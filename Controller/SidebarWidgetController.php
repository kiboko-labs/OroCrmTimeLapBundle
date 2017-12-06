<?php

namespace RA\OroCrmTimeLapBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use Oro\Bundle\TaskBundle\Entity\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SidebarWidgetController extends Controller
{
    /**
     * @var |TaskRepository
     */
    private $taskRepository;

    /**
     * SidebarWidgetController constructor.
     *
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @Route("/widget/sidebar/{perPage}", name="timelap_sidebar_widget", defaults={"perPage" = 10})
     * @Template("RAOroCrmTimeLapBundle:Task/widget:tasksWidget.html.twig")
     *
     * @param integer $perPage
     * @return array
     */
    public function timeTrackingWidgetAction($perPage)
    {
        $id = $this->getUser()->getId();
        $perPage = (int)$perPage;
        $tasks = $this->taskRepository->getTasksAssignedTo($id, $perPage);

        return ['tasks' => $tasks];
    }
}
