<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        *{
            padding-inline: 1rem;
            margin-block: 0.35rem;
        }
        header{
            display: grid;
            grid-column-gap: 5mm;
        }
        .subheading{
            padding: 0;
        }

        table{
            border-collapse: collapse;
            border: 1px solid black; /* Add border to the table */
            width: 100%; /* Set the table width to 100% */
        }
    
        th {
            width: 30%; /* Set the width of the header column */
            border: 1px solid black; /* Add border to the header cells */
            padding: 10px; /* Add some padding to the header cells */
            text-align: left; /* Align the text to the left */
          }
          
          td {
            width: 70%; /* Set the width of the content column */
            border: 1px solid black; /* Add border to the content cells */
            padding: 10px; /* Add some padding to the content cells */
          }
    </style>
</head>
<body>
    <header>
        <h1>COUNTY GOVERNMENT OF KITUI</h1>
        <div class="subheading">
            <h2 style="text-decoration: underline;">ICT DEPARTMENT</h2>
            <h3 style="text-decoration: underline;">SERVICE REQUEST FORM</h3>
        </div>
    </header>

    <main>
        <!-- <section> -->
            <h4 style=>User Details</h4>
            <div style="padding-block: 0.25rem;">
                <table>
                    <tr>
                        <th>DEPARTMENT</th>
                        <td>Ministry of LIUD</td>
                    </tr>

                    <tr>
                        <th>REPORTED BY</th>
                        <td>{{ $job->reportedBy }}</td>
                    </tr>

                    <tr>
                        <th>MOBILE/TEL. NO</th>
                        <td>{{ $job->telephone }}</td>
                    </tr>

                    <tr>
                        <th>DATE OF REQUEST</th>
                        <td>23-FEB-2023</td>
                    </tr>

                    <tr>
                        <th>DESIGNATION</th>
                        <td>SECRETARY</td>
                    </tr>
                </table>
            </div>

            <h4 style=>Equipment Details</h4>
            <div style="padding-block: 0.25rem;">
                <table>
                    <tr>
                        <th>EQUIPMENT NAME</th>
                        <td>{{ $job->eqptName }}</td>
                    </tr>

                    <tr>
                        <th>MODEL</th>
                        <td>{{ $job->model }}</td>
                    </tr>

                    <tr>
                        <th>SERIAL NO</th>
                        <td>{{ $job->serial }}</td>
                    </tr>
                </table>
            </div>
        <!-- </section> -->

        <h4 style=>DESCRIPTION OF FAULT</h4>
        <div class="description" style="padding-block: 0.25rem;">
            <table>
                <tr>
                    <th>Hardware/Software/Technical</th>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem cumque perferendis quo delectus at veritatis omnis rerum, fugiat aut sunt provident voluptate perspiciatis officia illum? Delectus minus labore quo itaque?</td>
                </tr>
            </table>
        </div>

        <h4 style=>JOB DETAILS</h4>
        <div style="padding-block: 0.25rem;">
            <table>
                <tr>
                    <th>JOB NUMBER</th>
                    <td>{{ $job->id }}</td>
                </tr>
                <tr>
                    <th>JOB ASSIGNED TO</th>
                    <td>{{ $job->ICT }}</td>
                </tr>
                <tr>
                    <th>ASSIGNED DATE/TIME</th>
                    <td>{{ $job->created_at }}</td>
                </tr>
            </table>
        </div>

        <h4 style=>SUMMARY</h4>
        <div style="padding-block: 0.25rem;">
            <table>
                <tr>
                    <th>SUMMARY</th>
                    <td>
                       {{ $job->summary }}
                    </td>
                </tr>

                <tr>
                    <th>TOTAL HOURS TAKEN</th>
                    <td>1 hr</td>
                </tr>
            </table>
        </div>

        <h4 style=>REMARKS</h4>
        <div style="padding-block: 0.25rem;">
            <table>
                <tr>
                    <th>REMARKS</th>
                    <td>{{ $job->remarks }}</td>
                </tr>

                <tr>
                    <th>JOB COMPLETED ON</th>
                    <td>{{ $job->created_at->format('Y-m-d') }}</td>
                </tr>
            </table>
        </div>


        <div style="padding-block: 0.25rem;">
            <p style="font-weight: 400;">CONFIRMED BY USER DEPARTMENT</p>
            <span style="text-decoration: none; padding-top: 1.5rem;">.....................................................</span>
        </div>
    
        <div style="padding-block: 0.5rem;">
            <p style="font-weight: 400;">DATE: <span style="text-decoration: underline; font-size: 1.25rem;">23-FEB-2023</span></p>
        </div>

    </main>
</body>
</html>