<?php

namespace App\Controllers;

use App\Models\TodoModel;

class Home extends BaseController
{
    public function index()
    {
        $todoModel = new TodoModel();
        $data['todos'] = $todoModel->findAll();

        // Check Xdebug and PCOV status
        $data['xdebug_enabled'] = $this->isExtensionEnabled('xdebug');
        $data['pcov_enabled'] = $this->isExtensionEnabled('pcov');

        return view('todo_list', $data);
    }

    private function isExtensionEnabled($extension)
    {
        return extension_loaded($extension) ? 'Enabled' : 'Disabled';
    }
}
