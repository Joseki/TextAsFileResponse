TextAsFileResponse
==================

Text as file response for Nette Framework

Install
---
Installation via Composer.

    {
        "require":{
            "joseki/text-as-file-response": "@dev"
        }
    }


Download a file from a template
---

    // in a Presenter
    public function actionDownload()
    {
        $template = $this->createTemplate();
        $template->setFile("/path/to/template.latte");
        $template->someValue = 123;

        $response = new Joseki\Application\Responses\TextAsFileResponse($template, 'MyFilename.txt');

        $this->sendResponse($response);
    }



Download a file from a string
---

    // in a Presenter
    public function actionDownload()
    {
        $data = 'lorem ipsum...';

        $response = new Joseki\Application\Responses\TextAsFileResponse($data, 'MyFilename.txt');

        $this->sendResponse($response);
    }



Setting content type
---

    // in a Presenter
    public function actionDownload()
    {
        $response = new Joseki\Application\Responses\TextAsFileResponse($data, 'MyFilename.xml', 'application/xml');

        $this->sendResponse($response);
    }
