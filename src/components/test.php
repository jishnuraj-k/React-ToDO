<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use App\DataTables\Admin\JobPostDataTable;
use Cassandra\Exception\ValidationException;
class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobPostDataTable $dataTable)
        {
            return $dataTable->render('components.datatable.index',
                [
                    'title'=>'JobPost',
                    'heading'=>'Grid View',
                    'buttons'=>[
                        [
                            'route'=>'jobpost.create',
                            'title'=>'New',
                            'color'=>'primary',
                            'permission'=>'jobpost_create'
                        ]
                    ]
                ]);
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobpost.create_jobpost');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreAndPost(Request $request)
    {
                    // Set up LinkedIn application credentials
        $clientId = '<your_client_id_here>';
        $clientSecret = '<your_client_secret_here>';
        $redirectUri = '<your_redirect_uri_here>';
    
                    // Set up LinkedIn API endpoints
        $authorizationEndpoint = 'https://www.linkedin.com/oauth/v2/authorization';
        $tokenEndpoint = 'https://www.linkedin.com/oauth/v2/accessToken';

//        $this->validator($request->all())->validate();
        $jobpost = JobPost::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'skills_description' => $request->skills_description,
            'company_job_code' => $request->company_job_code,
            'experience_Level' => $request->experience_Level,
            'employment_Status' => $request->employment_Status,

        ]);

            // Read HTML form data
            $companyName = $request->companyName;
            $companyWebsite = $request->companyWebsite;
            $jobTitle = $request->jobTitle;
            $jobDescription = $request->jobDescription;
            $jobRequirements = $request->jobRequirements;
            $employmentType = $request->employmentType;
            $jobFunction = $request->jobFunction;
            $city = $$request->city;
            $countryCode = $request->countryCode;
            $postalCode = $request->postalCode;
            $region = $request->region;
            $streetAddress = $request->streetAddress;
            $latitude = $request->latitude;
            $longitude = $request->longitude;
            $partnerJobId = $request->partnerJobId;
            $partnerJobUrl =$request->partnerJobUrl;

            // Create JSON payload
            $payload = array(
                'job' => array(
                    'activateStatus' => 'ACTIVE',
                    'company' => array(
                        'name' => $companyName,
                        'websiteUrl' => $companyWebsite
                    ),
                    'description' => array(
                        'text' => $jobDescription,
                        'requirements' => $jobRequirements
                    ),
                    'employmentType' => array(
                        $employmentType
                    ),
                    'functions' => array(
                        $jobFunction
                    ),
                    'locations' => array(
                        array(
                            'address' => array(
                                'city' => $city,
                                'countryCode' => $countryCode,
                                'postalCode' => $postalCode,
                                'region' => $region,
                                'streetAddress' => $streetAddress
                            ),
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'name' => $city . ', ' . $region
                        )
                    ),
                    'title' => $jobTitle
                ),
                'partnerJobId' => $partnerJobId,
                'partnerJobUrl' => $partnerJobUrl
            );


                // Set up request parameters for authorization endpoint
                $authorizationParams = array(
                    'response_type' => 'code',
                    'client_id' => $clientId,
                    'redirect_uri' => $redirectUri,
                    'scope' => 'r_liteprofile w_member_social',
                    'state' => '123456789'
                );

                // Build authorization URL and redirect user to LinkedIn's login page
                $authorizationUrl = $authorizationEndpoint . '?' . http_build_query($authorizationParams);
                header('Location: ' . $authorizationUrl);
                exit;

                // Once user has logged in and been redirected back to your application...
                if (isset($_GET['code'])) {
                    // Set up request parameters for token endpoint
                    $tokenParams = array(
                        'grant_type' => 'authorization_code',
                        'code' => $_GET['code'],
                        'redirect_uri' => $redirectUri,
                        'client_id' => $clientId,
                        'client_secret' => $clientSecret,
                        'payload' => $payload
                    );

                    // Initialize curl session
                    $ch = curl_init();
 
                    // Set curl options
                    curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenParams));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                    // Execute curl request
                    $response = curl_exec($ch);

                    // Close curl session
                    curl_close($ch);

                    // Decode response JSON and extract access token
                    $accessToken = json_decode($response)->access_token;

                    // Use access token to make authenticated requests to the Job Posting API
                    // ...
                }

                // Convert payload to JSON format
                $jsonPayload = json_encode($payload);

                // Output JSON payload
                echo $jsonPayload;

        return redirect('jobpost');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function show(JobPost $jobPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPost $jobPost)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPost $jobPost)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPost  $jobPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPost $jobPost)
    {
        //
    }
}