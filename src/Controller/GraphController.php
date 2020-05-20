<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Amenadiel\JpGraph\Graph\Graph;
use Amenadiel\JpGraph\Plot\LinePlot;

class GraphController extends Controller
{
    /**
     * @Route("/diagram/histogram", name="graphics")
     * @Method("GET")
     * @Security("has_role('ROLE_USER')")
     */

    public function makeGraph() //линейный график
    {
       // $coeff = $request->request->get("buildGraphForm"); //значения коэффициентов
        $xdata = array(0, 1, 2, 3, 4, 5, 6);
        $graph = new Graph(400, 300, 'auto', 10, true);
        $graph->SetScale('textlin');
        $lineplot = new LinePlot($xdata);
        $lineplot->SetColor('forestgreen');
        $graph->Add($lineplot);
        $graph->title->Set('Значения коэффициента');
        $graph->title->SetFont(FF_VERDANA, FS_NORMAL);
        $graph->xaxis->title->SetFont(FF_VERDANA, FS_ITALIC);
        $graph->yaxis->title->SetFont(FF_VERDANA, FS_ITALIC);
        $graph->xaxis->title->Set('Временные промежутки');
        $graph->yaxis->title->Set('Значения коэффициента');
        //$lineplot->value->Show();
        //$graph->Stroke();
        //переводим в base64 и передаем в js
        ob_start();
        $graph->img->Stream();
        $image_data = ob_get_contents();
        ob_end_clean();
        $image = base64_encode($image_data);
        //return new Response("<img src='data:image/png;base64,$image'>");
        return new Response($image);
       // return $image->render('index.html.twig');
    }
}