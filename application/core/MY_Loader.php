<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Define Site Template
     * @param type $view_name
     * @param type $vars
     * @param type $return
     * @return type
     */
    public function template($view_name, $vars = array(), $return = FALSE, $template = 'site')
    {
        $content = $this->view('templates/' . $template . '/header', $vars, $return);
        $content .= $this->view('templates/' . $template . '/' . $view_name, $vars, $return);
        $content .= $this->view('templates/' . $template . '/footer', $vars, $return);
        if ($return)
        {
            return $content;
        }
    }

    /**
     * Define Template for user
     * @param type $view_name
     * @param type $vars
     * @param type $return
     * @param type $exclude
     * @return type
     */
    public function user_template($view_name, $vars = array(), $return = FALSE, $exclude = FALSE)
    {
        $content = '';
        if ($exclude == false)
            $content = $this->view('templates/user/header', $vars, $return);

        $content .= $this->view('templates/user/' . $view_name, $vars, $return);

        if ($exclude == false)
            $content .= $this->view('templates/user/footer', $vars, $return);

        if ($return)
        {
            return $content;
        }
    }

    public function auth_template($view_name, $vars = array(), $return = TRUE, $exclude = FALSE)
    {
        $content = '';

        if ($exclude == FALSE)
            $content .= $this->view('auth/header', $vars, $return);

        $content .= $this->view('/' . $view_name, $vars, $return);

        if ($exclude == FALSE)
            $content .= $this->view('auth/footer', $vars, $return);

        if ($return)
        {
            return $content;
        }
    }

    public function print_template($view_name, $vars = array(), $return = FALSE)
    {
        $content = $this->view('templates/print/header', $vars, $return);

        $content .= $this->view('templates/print/' . $view_name, $vars, $return);
        if ($return)
        {
            return $content;
        }
    }

    /**
     * Define Site Template
     * @param type $view_name
     * @param type $vars
     * @param type $return
     * @return type
     */
    public function admin_template($view_name = NULL, $vars = array(), $return = FALSE)
    {
        $content = $this->view('templates/admin/header', $vars, $return);

        if ($view_name != NULL)
            $content .= $this->view('templates/admin/' . $view_name, $vars, $return);

        $content .= $this->view('templates/admin/footer', $vars, $return);
        if ($return)
        {
            return $content;
        }
    }

}
