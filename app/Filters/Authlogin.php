<?php namespace App\Filters;



use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\HTTP\ResponseInterface;

use CodeIgniter\Filters\FilterInterface;

use PhpParser\Builder\class_;





class Authlogin implements FilterInterface

{

    

    public function before(RequestInterface $request, $arguments = null)

    {

        // Do something here

        // helper('coustom');


        // set_error_handler("customErrorHandlerCheck");

        

        if(session()->get('isLoggedIn'))

        {

            // date_default_timezone_set('Asia/Kolkata');

            // $user_access = 0;

            // if($_SESSION['role_number'] == '1')

            // {

            //     $user_access = 1;

            // }else if($_SESSION['role_number'] == '2'){

            //     $user_access = 1;

            // }else{

            //     $start_time = $_SESSION['active_form_time'];

            //     $end_time = $_SESSION['active_to_time'];

            //     $current_time = date('H:i');

            //     $dayname = date('l');

            //     $login_Day = $_SESSION['week_of_day'];



            //     if($start_time < $current_time && $current_time < $end_time)

            //     {

            //         // session_destroy();

            //         $user_access = 1;

            //     }

            //     if(strtolower($dayname) == $login_Day )

            //     {

            //         // session_destroy();

            //         $user_access = 0;

            //     }

            // }

            // if($user_access != 1){

            //     session()->destroy();

            //     return redirect()->to(base_url('login'));

            // }

        }

        else

        {

            return redirect()->to(base_url('login'));

        }

    }



    //--------------------------------------------------------------------



    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)

    {

        // Do something here

    }

}