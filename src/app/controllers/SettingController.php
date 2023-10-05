<?php
class SettingController extends Controller implements ControllerInterface
{
    public $data;
    public function index()
    {
        $settingView = $this->view('setting', 'SettingView');
        $settingView->render();
    }
}