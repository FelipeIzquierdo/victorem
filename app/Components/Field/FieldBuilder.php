<?php namespace Victorem\Components\Field;

use Collective\Html\FormBuilder as Form;
use Illuminate\View\Factory as View;
use Illuminate\Session\Store as Session;

class FieldBuilder {

    protected $form;
    protected $view;
    protected $session;

    protected $defaultTemplate = [
        'default'       => 'default',
        'dateRange'     => 'date-range',
        'time'          => 'time'
    ];

    protected $defaultClass = [
        'default'           => 'form-control',
        'dateRange'         => 'form-control',
        'select'            => 'select-chosen',
        'time'              => 'form-control input-timepicker'
    ];

    public function __construct(Form $form, View $view,  Session $session)
    {
        $this->form =  $form;
        $this->view = $view;
        $this->session = $session;
    }

    public function getDefaultClass($type)
    {
        if(isset($this->defaultClass[$type]))
        {
            return $this->defaultClass[$type];
        }
        return $this->defaultClass['default'];
    }

    public function  getDefaultTemplate($type = null)
    {
        if(isset($this->defaultTemplate[$type]))
        {
            return $this->defaultTemplate[$type];
        }
        return $this->defaultTemplate['default'];
    }

    public  function buildCssClasses($type, &$attributes)
    {
        $defaultClasses = $this->getDefaultClass($type);

        if(isset ($attributes['class']))
        {
            $attributes['class'] .= ' '.$defaultClasses;
        }
        else
        {
            $attributes['class'] = $defaultClasses;
        }
    }

    public function buildLabel($name)
    {
        $name = preg_replace('/\[[0-9]*\]/i', '', $name);
        if(\Lang::has('validation.attributes.'.$name))
        {
            $label = \Lang::get('validation.attributes.'.$name);
        }
        else
        {
            $label = str_replace('_', ' ', $name);
        }
        return ucfirst($label);
    }

    public function buildControl($type, $name, $value = null, $attributes = array(), $options = array())
    {
        switch($type)
        {
            case 'select':
                return $this->form->select($name, $options, $value, $attributes);
            case 'selectSimple':
                return $this->form->select($name, $options, $value, $attributes);
            case 'password':
                return $this->form->password($name,$attributes);
            case 'checkbox':
                return $this->form->checkbox($name, $value);
            case 'textarea':
                return $this->form->textarea($name, $value, $attributes );
            case 'time':
                return $this->form->text($name, $value, $attributes );
            default:
                return $this->form->input($type, $name, $value, $attributes);
        }
    }

    public function buildError($name)
    {
        $name = str_replace('[]', '', $name);
        $error = null;
        if($this->session->has('errors'))
        {
            $errors = $this->session->get('errors');

            if($errors->has($name))
            {
                $error = $errors->first($name);
            }
        }
        return $error;
    }

    public function  buildTemplate($type = null, $attributes =array())    
    {
        if(array_key_exists('template',$attributes) && \File::exists('../resources/views/fields/'.$attributes['template'].'.blade.php'))
        {
            return 'fields/'.$attributes['template'];
        }
        return 'fields/'.$this->getDefaultTemplate($type);
    }

    public  function  input($type, $name, $value = null, $attributes = array(), $options = array())
    {
        $this->buildCssClasses($type, $attributes);
        $label = $this->buildLabel($name);
        $control = $this->buildControl($type, $name, $value , $attributes , $options );
        $error = $this->buildError($name);
        $template = $this->buildTemplate($type, $attributes);

        if(in_array('required', $attributes))
        {
            $required = true;
        }

        return $this->view->make($template, compact('name', 'label', 'control', 'error', 'required'));

    }

    public  function select($name, $options, $value = null, $attributes = array())
    {
        if(!in_array('multiple', $attributes))
        {
            $options = ['' => ''] + $options;
        }

        return $this->input('select', $name, $value, $attributes, $options);
    }

    public  function selectSimple($name, $options, $value = null, $attributes = array())
    {
        return $this->input('selectSimple', $name, $value, $attributes, $options);
    }

    public function  password($name, $attributes = array())
    {
        return $this->input('password', $name, null, $attributes );
    }

    public function dateRange($name1, $name2, $value1 = null, $value2 = null, $attributes1 = array(), $attributes2 = array())
    {
        $this->buildCssClasses('dateRange', $attributes1);
        $this->buildCssClasses('dateRange', $attributes2);
        $label = $this->buildLabel($name1 . '_' . $name2);
        $control1 = $this->buildControl('text', $name1, $value1 , $attributes1);
        $control2 = $this->buildControl('text', $name2, $value2 , $attributes2);
        $error1 = $this->buildError($name1);
        $error2 = $this->buildError($name2);
        $template = $this->buildTemplate('dateRange', $attributes1 + $attributes2);

        return $this->view->make($template, compact('label', 'name1', 'name2', 'control1', 'control2', 'error1', 'error2'));
    }

    public function __call($method, $params)
    {
        array_unshift($params,$method);
        return call_user_func_array([$this, 'input'],$params);
    }

} 