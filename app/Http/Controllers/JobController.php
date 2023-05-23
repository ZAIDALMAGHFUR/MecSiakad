<?php

namespace App\Http\Controllers;

use finfo;
use Illuminate\Http\Request;

class JobController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */

  public function index(Request $request)
  {

    $keyword = $request->input('keyword');
    $location = $request->input('location');

    $country_name = file_get_contents('../countries.json');
    $country_name = json_decode($country_name);

    if ($keyword == null && $location == null) {
      $loker = ["init" => true];
      return view('dashboard.jobSearch.index', compact('loker', 'country_name'));
    }
    
    $country_code = 'ID';
    $symbol = 'Rp';

//    if ( ! empty($location) ) {
      $country = file_get_contents('../countries.json');
      $country = json_decode($country);
  
      foreach ( $country as $data ) {
        if ( strtolower($data->name->common) == strtolower($location)) {
            $country_code = $data->cca2;
            }
        }
  //    }

    if ($keyword != null) {
      $search_term = '"SearchTerm":"' . $keyword . '",';
    } else {
      $search_term = '';
    }

    $post = '{"operationName":"searchJobs","variables":{"data":{' . $search_term . '"CountryCode":"' . $country_code . '","limit":60,"offset":0,"includeExternalJobs":true,"sources":["NATIVE","SUPER_POWERED"]}},"query":"query searchJobs($data: JobSearchConditionInput!) {\n  searchJobs(data: $data) {\n    jobsInPage {\n      id\n      title\n      isRemote\n      status\n      createdAt\n      updatedAt\n      isActivelyHiring\n      isHot\n      shouldShowSalary\n      salaryEstimate {\n        minAmount\n        maxAmount\n        CurrencyCode\n        __typename\n      }\n      company {\n        ...CompanyFields\n        __typename\n      }\n      citySubDivision {\n        id\n        name\n        __typename\n      }\n      city {\n        ...CityFields\n        __typename\n      }\n      country {\n        ...CountryFields\n        __typename\n      }\n      category {\n        id\n        name\n        __typename\n      }\n      salaries {\n        ...SalaryFields\n        __typename\n      }\n      minYearsOfExperience\n      maxYearsOfExperience\n      source\n      __typename\n    }\n    totalJobs\n    __typename\n  }\n}\n\nfragment CompanyFields on Company {\n  id\n  name\n  logo\n  __typename\n}\n\nfragment CityFields on City {\n  id\n  name\n  __typename\n}\n\nfragment CountryFields on Country {\n  code\n  name\n  __typename\n}\n\nfragment SalaryFields on JobSalary {\n  id\n  salaryType\n  salaryMode\n  maxAmount\n  minAmount\n  CurrencyCode\n  __typename\n}\n"}';  
    //dd($post);
      $ch = curl_init('https://glints.com/api/graphql');
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
      $result = curl_exec($ch); 
      curl_close($ch);
      $data = json_decode($result, true);
      $data = $data['data']['searchJobs']['jobsInPage'];
      //  dd($data); 
      $loker = [];
      foreach ($data as $key => $value) {

        if (isset($value['salaries']['0']['CurrencyCode'])) {
          foreach ( $country as $data ) {
            foreach ($data->currencies as $currency => $currency_data) {
              if ($currency == $value['salaries']['0']['CurrencyCode']) {
                $symbol = $currency_data->symbol;
              }
            }
          }
        }

        isset($value['salaries']['0']['minAmount']) ? $value['salaries']['0']['minAmount'] = $symbol . ' ' . number_format($value['salaries']['0']['minAmount'], 0, ',', '.') : $value['salaries']['0']['minAmount'] = '';
        isset($value['salaries']['0']['maxAmount']) ? $value['salaries']['0']['maxAmount'] = $symbol . ' ' . number_format($value['salaries']['0']['maxAmount'], 0, ',', '.') : $value['salaries']['0']['maxAmount'] = '';
      
        isset($value['citySubDivision']['name']) ? $value['citySubDivision']['name'] = $value['citySubDivision']['name'] . ', ' : $value['citySubDivision']['name'] = '';
        isset($value['city']['name']) ? $value['city']['name'] = $value['city']['name'] : $value['city']['name'] = '';
      
        $date_glints = $value['updatedAt'];
        $date_glints = date('Y-m-d', strtotime($date_glints));
        $date_glints = strtotime($date_glints);
        $date_now = strtotime(date('Y-m-d'));
        $date_diff = $date_now - $date_glints;
        $date_diff = floor($date_diff / (60 * 60 * 24));

        $loker[] = [
          'img' => $value['company']['logo'],
          'title' => $value['title'],
          'perusahaan' => $value['company']['name'],
          'lokasi' => $value['citySubDivision']['name'] . $value['city']['name'],
          'gaji' => $value['salaries']['0']['minAmount'] . ' - ' . $value['salaries']['0']['maxAmount'],
          'pengalaman' => $value['minYearsOfExperience'] . ' - ' . $value['maxYearsOfExperience'] . ' Tahun',
          'status' => $value['status'],
          'update' => $date_diff,
          'link' => 'https://glints.com/id/opportunities/jobs/' . $value['id'],
        ];
      
      }
      
      

    return view('dashboard.jobSearch.index', compact('loker', 'country_name'));

  }

  public function search($search)
  {
    $country = file_get_contents('../countries.json');
    $country = json_decode($country);

    $array = [];

    foreach ( $country as $data ) {
      if (str_contains(strtolower($data->name->common), strtolower($search))) {
        $array[] = [
          "country" => $data->name->common
        ];
      }
    }
  
    return response()->json($array);
  }
}
