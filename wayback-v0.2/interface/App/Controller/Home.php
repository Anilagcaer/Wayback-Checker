<?php

namespace App\Controller;

use Effernet\Core\Application\Controller;

class Home extends Controller{

    public function index()
    {
        $this->setLayout('main');
        $this->render('home_page');
    }

    public function urlCreate()
    {
        $request_parameters = $this->prepareUrlToApi($_POST);
        $result = $this->basicCallAPI('http://localhost:8000/' . $request_parameters['url'] . '/' . $request_parameters['parameters']);
        $data['api_result'] = json_decode($result, true);
        $this->setLayout('main');
        $this->render('home_page', $data);
    }

    private function urlCreator(array $values): string
    {
        $base = sprintf("http://web.archive.org/cdx/search/cdx?url=%s/*&output=%s&collapse=%s", $values['url'], $values['output'], $values['collapse']);
        if ($values['fl'] === "original")
            $base = $base . "&fl=original";
        if (!empty($values['status']))
            $base = $base . "&status=" . $values['status'];
        if ($values['limit'] != 0)
            $base = $base . "&limit=" . $values['limit'];
        if (!empty($values['timestamp']))
            $base = $base . "&timestamp=" . $values['timestamp'];
        return $base;
    }

    private function prepareUrlToApi(array $values): array
    {
        $parameters = sprintf("*&output=%s&collapse=%s", $values['output'], $values['collapse']);
        if ($values['fl'] === "original")
            $parameters = $parameters . "&fl=original";
        if (!empty($values['status']))
            $parameters = $parameters . "&status=" . $values['status'];
        if ($values['limit'] != 0)
            $parameters = $parameters . "&limit=" . $values['limit'];
        if (!empty($values['timestamp']))
            $parameters = $parameters . "&timestamp=" . $values['timestamp'];
        return [
            'url' => $values['url'],
            'parameters' => $parameters
        ];
    }

    private function basicCallAPI(string $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }



}