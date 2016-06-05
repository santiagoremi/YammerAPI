<?php

namespace bluenove\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use bluenove\PlatformBundle\Entity\Groupe;
use bluenove\PlatformBundle\Repository\GroupeRepository;
use bluenove\PlatformBundle\Entity\Users;
use bluenove\PlatformBundle\Repository\UsersRepository;

class ExcelController extends Controller {

    /**
     * 
     *
     * @Route("/exportgroupe", name="export_excel_group")
     */
    public function exportGroupeAction() {
        // ask the service for a Excel5
        $em = $this->getDoctrine()->getManager();
        $groupes = $em->getRepository("PlatformBundle:Groupe")->findall();

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("SANTI")
                ->setLastModifiedBy("Rémi SANTIAGO")
                ->setTitle("Export Groupes stats")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");

        $phpExcelObject->createSheet(0);

        $j = 2;
        foreach ($groupes as $groupe) {
            $users_in_groupe = $groupe->getUsers();
            $users_array = $users_in_groupe->toArray();

            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . 1, "Groupe Name")
                    ->setCellValue('B' . 1, "Groupe Id")
                    ->setCellValue('C' . 1, "Nombre de publication")
                    ->setCellValue('D' . 1, "Nombre de messages")
                    ->setCellValue('E' . 1, "Nombre de commentaires")
                    ->setCellValue('F' . 1, "Nombre de likes")
                    ->setCellValue('G' . 1, "Nombre de membres")
                    ->setCellValue('H' . 1, "Date derniere publication")
                    ->setCellValue('A' . $j, $groupe->getName())
                    ->setCellValue('B' . $j, $groupe->getIdGroupe())
                    ->setCellValue('C' . $j, $groupe->getNbPost() + $groupe->getNbCom())
                    ->setCellValue('D' . $j, $groupe->getNbPost())
                    ->setCellValue('E' . $j, $groupe->getNbCom())
                    ->setCellValue('F' . $j, $groupe->getNbLikes())
                    ->setCellValue('G' . $j, $groupe->getNbMembers())
                    ->setCellValue('H' . $j, $groupe->getDateLastPubli());


            $j = $j + 1;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Groupes');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Export_Groupes_stats.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * 
     *
     * @Route("/exportuser", name="export_excel_user")
     */
    public function exportUserAction() {
        // ask the service for a Excel5
        $em = $this->getDoctrine()->getManager();
//        $users = $em->getRepository("PlatformBundle:Users")->findall();
        $users = $em->getRepository("PlatformBundle:Users")->findall();


        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("SANTI")
                ->setLastModifiedBy("Rémi SANTIAGO")
                ->setTitle("Export Users Stats")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");

        $phpExcelObject->createSheet(0);

        $j = 2;
        foreach ($users as $user) {
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . 1, "User Name")
                    ->setCellValue('B' . 1, "User Id")
                    ->setCellValue('C' . 1, "Entreprise")
                    ->setCellValue('D' . 1, "Job Title")
                    ->setCellValue('E' . 1, "Departement")
                    ->setCellValue('F' . 1, "Email")
                    ->setCellValue('G' . 1, "Date d'inscription")
                    ->setCellValue('H' . 1, "Nombre de publication")
                    ->setCellValue('I' . 1, "Nombre de messages")
                    ->setCellValue('J' . 1, "Nombre de commentaires")
                    ->setCellValue('K' . 1, "Nombre de likes")
                    ->setCellValue('L' . 1, "Date derniere publication")
                    ->setCellValue('A' . $j, $user->getName())
                    ->setCellValue('B' . $j, $user->getUserId())
                    ->setCellValue('C' . $j, $user->getNetworkName())
                    ->setCellValue('D' . $j, $user->getJobTitle())
                    ->setCellValue('E' . $j, $user->getDepartement())
                    ->setCellValue('F' . $j, $user->getEmail())
                    ->setCellValue('G' . $j, $user->getDateInscription())
                    ->setCellValue('H' . $j, $user->getNbPost() + $user->getNbCom())
                    ->setCellValue('I' . $j, $user->getNbPost())
                    ->setCellValue('J' . $j, $user->getNbCom())
                    ->setCellValue('K' . $j, $user->getNbLikes())
                    ->setCellValue('L' . $j, $user->getDateLastPubli());



            $j = $j + 1;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Groupes');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Export_Users_stats.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * 
     *
     * @Route("/exportuserdate", name="export_excel_user_date")
     */
    public function exportUserByDateAction() {
        // ask the service for a Excel5
        $em = $this->getDoctrine()->getManager();
//        $users = $em->getRepository("PlatformBundle:Users")->findall();
        $users = $em->getRepository("PlatformBundle:Users")->findall();


        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("SANTI")
                ->setLastModifiedBy("Rémi SANTIAGO")
                ->setTitle("Export Users Stats")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");

        $phpExcelObject->createSheet(0);

        $j = 2;
        foreach ($users as $user) {
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . 1, "User Name")
                    ->setCellValue('B' . 1, "User Id")
                    ->setCellValue('C' . 1, "Entreprise")
                    ->setCellValue('D' . 1, "Job Title")
                    ->setCellValue('E' . 1, "Departement")
                    ->setCellValue('F' . 1, "Email")
                    ->setCellValue('G' . 1, "Date d'inscription")
                    ->setCellValue('H' . 1, "Nombre de publication")
                    ->setCellValue('I' . 1, "Nombre de messages")
                    ->setCellValue('J' . 1, "Nombre de commentaires")
                    ->setCellValue('K' . 1, "Nombre de likes")
                    ->setCellValue('L' . 1, "Date derniere publication")
                    ->setCellValue('A' . $j, $user->getName())
                    ->setCellValue('B' . $j, $user->getUserId())
                    ->setCellValue('C' . $j, $user->getNetworkName())
                    ->setCellValue('D' . $j, $user->getJobTitle())
                    ->setCellValue('E' . $j, $user->getDepartement())
                    ->setCellValue('F' . $j, $user->getEmail())
                    ->setCellValue('G' . $j, $user->getDateInscription())
                    ->setCellValue('H' . $j, $user->getNbTempPost() + $user->getNbTempCom())
                    ->setCellValue('I' . $j, $user->getNbTempPost())
                    ->setCellValue('J' . $j, $user->getNbTempCom())
                    ->setCellValue('K' . $j, $user->getNbTempLikes())
                    ->setCellValue('L' . $j, $user->getDateLastPubliTemp());



            $j = $j + 1;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Groupes');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Export_Users_bydate_stats.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * 
     *
     * @Route("/exportExcelUserGroupeDate/{groupe_id}", name="export_excel_user_groupe_date")
     */
    public function exportUserByGroupeByDateAction($groupe_id) {
        // ask the service for a Excel5
        $em = $this->getDoctrine()->getManager();

        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupe_id));
        $users_in_groupe = $groupe[0]->getUsers();
        $users = $users_in_groupe->toArray();

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("SANTI")
                ->setLastModifiedBy("Rémi SANTIAGO")
                ->setTitle("Export Users Stats")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");

        $phpExcelObject->createSheet(0);

        $j = 2;
        foreach ($users as $user) {
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . 1, "User Name")
                    ->setCellValue('B' . 1, "User Id")
                    ->setCellValue('C' . 1, "Entreprise")
                    ->setCellValue('D' . 1, "Job Title")
                    ->setCellValue('E' . 1, "Departement")
                    ->setCellValue('F' . 1, "Email")
                    ->setCellValue('G' . 1, "Date d'inscription")
                    ->setCellValue('H' . 1, "Nombre de publication")
                    ->setCellValue('I' . 1, "Nombre de messages")
                    ->setCellValue('J' . 1, "Nombre de commentaires")
                    ->setCellValue('K' . 1, "Date derniere publication")
                    ->setCellValue('A' . $j, $user->getName())
                    ->setCellValue('B' . $j, $user->getUserId())
                    ->setCellValue('C' . $j, $user->getNetworkName())
                    ->setCellValue('D' . $j, $user->getJobTitle())
                    ->setCellValue('E' . $j, $user->getDepartement())
                    ->setCellValue('F' . $j, $user->getEmail())
                    ->setCellValue('G' . $j, $user->getDateInscription())
                    ->setCellValue('H' . $j, $user->getNbTempPost() + $user->getNbTempCom())
                    ->setCellValue('I' . $j, $user->getNbTempPost())
                    ->setCellValue('J' . $j, $user->getNbTempCom())
                    ->setCellValue('K' . $j, $user->getDateLastPubliTemp());



            $j = $j + 1;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Groupes');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Export_Users_for_' . $groupe_id . '_filterbydate_stats.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * 
     *
     * @Route("/exportExcelUserGroupe/{groupe_id}", name="export_excel_user_groupe")
     */
    public function exportUserByGroupeAction($groupe_id) {
        // ask the service for a Excel5
        $em = $this->getDoctrine()->getManager();

        $groupe = $em->getRepository("PlatformBundle:Groupe")->findby(array('idGroupe' => $groupe_id));
        $users_in_groupe = $groupe[0]->getUsers();
        $users = $users_in_groupe->toArray();

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("SANTI")
                ->setLastModifiedBy("Rémi SANTIAGO")
                ->setTitle("Export Users Stats")
                ->setSubject("Office 2005 XLSX Test Document")
                ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
                ->setKeywords("office 2005 openxml php")
                ->setCategory("Test result file");

        $phpExcelObject->createSheet(0);

        $j = 2;
        foreach ($users as $user) {
            $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A' . 1, "User Name")
                    ->setCellValue('B' . 1, "User Id")
                    ->setCellValue('C' . 1, "Entreprise")
                    ->setCellValue('D' . 1, "Job Title")
                    ->setCellValue('E' . 1, "Departement")
                    ->setCellValue('F' . 1, "Email")
                    ->setCellValue('G' . 1, "Date d'inscription")
                    ->setCellValue('H' . 1, "Nombre de publication")
                    ->setCellValue('I' . 1, "Nombre de messages")
                    ->setCellValue('J' . 1, "Nombre de commentaires")
                    ->setCellValue('K' . 1, "Nombre de likes")
                    ->setCellValue('L' . 1, "Date derniere publication")
                    ->setCellValue('A' . $j, $user->getName())
                    ->setCellValue('B' . $j, $user->getUserId())
                    ->setCellValue('C' . $j, $user->getNetworkName())
                    ->setCellValue('D' . $j, $user->getJobTitle())
                    ->setCellValue('E' . $j, $user->getDepartement())
                    ->setCellValue('F' . $j, $user->getEmail())
                    ->setCellValue('G' . $j, $user->getDateInscription())
                    ->setCellValue('H' . $j, $user->getNbTempPost() + $user->getNbTempCom())
                    ->setCellValue('I' . $j, $user->getNbTempPost())
                    ->setCellValue('J' . $j, $user->getNbTempCom())
                    ->setCellValue('K' . $j, $user->getNbTempLikes())
                    ->setCellValue('L' . $j, $user->getDateLastPubliTemp());



            $j = $j + 1;
        }
        $phpExcelObject->getActiveSheet()->setTitle('Groupes');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'Export_Users_for_' . $groupe_id . '_stats.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

}
