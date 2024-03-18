<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class BreadcrumsComp
{
    private $breadcrumbs = array();
    private $separator = '  > ';
    private $start = '<ol class="breadcrumb" id="breadcrumb">';
    private $end = '</ol>';
    
    public function __construct($params = array())
    {
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }
    
    private function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->{'_' . $key})) {
                    $this->{'_' . $key} = $val;
                }
            }
        }
    }
    
    function add($title, $href)
    {
        if (!$title OR !$href)
            return;
        
        $this->breadcrumbs[] = array(
            'title' => $title,
            'href' => $href
        );
    }
    
    function output()
    {
        if ($this->breadcrumbs) {
            $output = $this->start;
            foreach ($this->breadcrumbs as $key => $crumb) {
                $crumbs = array_keys($this->breadcrumbs);

                $breadcrumbs = end($crumbs);
                
                if($breadcrumbs == $key){
                    $output .= '<li class="breadcrumb-item">' . $crumb['title'] . '</li>';
                }else {
                    $output .= '<li class="breadcrumb-item"><a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a></li>';
                }
            }
            return $output . $this->end . PHP_EOL;
        }
        return '';
    }
}