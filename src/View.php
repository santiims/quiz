<?php


namespace Quiz;


class View
{
    /**
     * @var string $viewFile
     */
    protected $viewFile;
    /**
     * @var string $templateFile
     */
    protected $templateFile;
    /**
     * @var string $js
     */
    protected $js = "";
    /**
     * @var string[]
     */
    protected $jsFiles = [];
    /**
     * @var string[]
     */
    protected $cssFiles =[];

    public function __construct(string $viewName, string $templateName)
    {
        $this->viewFile = $this->getFilePath($viewName);
        $this->templateFile = $this->getFilePath($templateName, TEMPLATE_BASE_FOLDER);
    }

    protected function getFilePath(string $fileName, string $baseDir = VIEW_BASE_FOLDER)
    {
        return $baseDir . DS . $fileName . '.php';
    }

    public function render(array $params = []): string                                  //Renders template
    {
        return $this->getFileContents($this->templateFile, $params);
    }

    public function renderContent(array $params = []): string                           //Renders view
    {
        return $this->getFileContents($this->viewFile, $params);
    }

    protected function getFileContents(string $fileName, array $params = [])
    {
        extract($params);
        $content = '';

        if (!empty($this->viewFile) && file_exists($fileName)) {
            ob_start();
            include "$fileName";
            $content = ob_get_clean();
        }
        return $content;
    }

    public function registerJs(string $js)
    {
        $this->js .= $js;
    }

    public function registerJsFile(string $fileName)
    {
        $this->jsFiles[] = $fileName;
    }

    public function registerCssFile(string $fileName)
    {
        $this->cssFiles[] = $fileName;
    }

    public function renderView(string $viewName, array $params = [])
    {
        $filePath = $this->getFilePath($viewName);

        return $this->getFileContents($filePath, $params);
    }
}