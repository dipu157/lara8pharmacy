<?php

if (!function_exists('get_company_title')) {

    function get_company_title($id = 1)
    {
        $company = \App\Models\Common\Company::find($id) ->value('title');

        return $company;
    }

}

if (!function_exists('get_company_name')) {

    function get_company_name($id = 1)
    {
        $company = \App\Models\Common\Company::find($id) ->value('name');

        return $company;
    }

}

if (!function_exists('get_company_logo')) {

    function get_company_logo($id = 1)
    {
        $company = \App\Models\Common\Company::find($id) ->value('logo_img');

        return $company;
    }

}
