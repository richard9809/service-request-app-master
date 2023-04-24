<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        header{
            display: grid;
            place-content: center;
        }

        h2, h3{
            display: grid;
            place-content: center;
            text-decoration: underline;
        }

        h4{
            font-size: 1.25rem;
        }

        h5{
            display: grid;
            place-content: center;
            font-size: 1.2rem;
        }

        h6{
            font-size: 1rem;
            display: grid;
            place-content: center;
        }
        .subheading{
            padding-top: .25rem;
        }

        main{
            padding-block: 1rem;
        }

        div > div > span{
            font-size: 1.25rem;
            text-decoration: underline;
        }

        main > div > div > p {
            padding-block: .25rem;
        }

        main > div > div > p > span {
            font-size: 1.25rem;
            padding-left: 1.5rem;
            text-decoration: underline;
        }

        .part-one{
            padding-block: 1rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .part-two{
            padding-block: 1rem;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

          .remarks{
            padding-block: 1rem;
          }

          .final{
            display: flex;
            justify-content: flex-end;
          }
    </style>
</head>
<body>
    <header>
        <h1>COUNTY GOVERNMENT OF KITUI</h1>
        <div class="subheading">
            <h2 >ICT DEPARTMENT</h2>
            <h3>SERVICE REQUEST FORM</h3>
        </div>
    </header>

    <main>
        <h4>PART (A): To Be Filled By User Departments</h4>
        <div class="part-one">
            <div>
                <p style="font-weight: 400;">DEPARTMENT: <span>Ministry of LIUD</span></p>
                <p style="font-weight: 400;">SERIAL NO: <span>201</span></p>
                <p style="font-weight: 400;">REPORTED BY: <span>JANE DOE</span></p>
                <p style="font-weight: 400;">MOBILE/TEL. NO: <span>0711467671</span></p>
            </div>

            <div>
                <p style="font-weight: 400;">EQUIPMENT NAME: <span>Printer</span></p>
                <p style="font-weight: 400;">MODEL: <span>HP</span></p>
                <p style="font-weight: 400;">DATE: <span>23-FEB-2023</span></p>
                <p style="font-weight: 400;">DESIGNATION: <span>SECRETARY</span></p>
            </div>
        </div>

        <section>
            <h4 style="text-decoration: underline;">NATURE OF FAULT/SERVICE REQUIRED</h4>
            <h5 style="padding-top: 1rem;">DESCRIPTION OF FAULT</h5>
            <div class="description" style="padding-inline: .5rem;">
                <table>
                    <tr>
                        <th>Hardware/Software/Technical</th>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem cumque perferendis quo delectus at veritatis omnis rerum, fugiat aut sunt provident voluptate perspiciatis officia illum? Delectus minus labore quo itaque?</td>
                    </tr>
                </table>
            </div>
        </section>

        <h4 style="padding-top: 1.5rem;">PART B: To Be completed by Information & Communication Technology Department.</h4>
        <div class="part-two">
            <div>
                <p style="font-weight: 400;">JOB NO: <span>23</span></p>
                <p style="font-weight: 400;">JOB ASSIGNED TO: <span>JOHN DOE</span></p>
            </div>

            <div>
                <p style="font-weight: 400;">RECEIVED DATE: <span>23-FEB-2023</span></p>
                <p style="font-weight: 400;">DATE: <span>23-FEB-2023</span></p>
            </div>

            <div>
                <p style="font-weight: 400;">TIME: <span>0930HRS</span></p>
                <p style="font-weight: 400;">TIME: <span>0930HRS</span></p>
            </div>
        </div>

        <div class="part-two">
            <div>
                <p style="font-weight: 400;">DATE</p>
                <span>23-FEB-2023</span>
            </div>

            <div>
                <p style="font-weight: 400;">SUMMARY OF THE WORK DONE</p>
                <span>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima nemo distinctio, enim cum obcaecati totam culpa dicta. Praesentium dolorem exercitationem laudantium minima, ducimus minus inventore soluta nemo iusto mollitia animi!</span>
            </div>

            <div style="padding-inline: 1.5rem;">
                <h6>TIME TAKEN</h6>
                <div class="part-two">
                    <div>
                        <p style="font-weight: 400;">FROM</p>
                        <span>0930hrs</span>
                    </div>
    
                    <div>
                        <p style="font-weight: 400;">TO</p>
                        <span>0945hrs</span>
                    </div>
    
                    <div>
                        <p style="font-weight: 400;">NO. HRS</p>
                        <span>15MINS</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="remarks">
            <div>
                <p style="font-weight: 400;">REMARKS: <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. </span></p>
            </div>

            <div>
                <p style="font-weight: 400;">JOB COMPLETED ON: <span>23-FEB-2023</span></p>
            </div>
        </div>

        <div class="final">
            <div>
                <div>
                    <p style="font-weight: 400;">CONFIRMED BY USER DEPARTMENT</p>
                    <span style="text-decoration: none; padding-top: 1.5rem;">.....................................................</span>
                </div>
    
                <div style="padding-block: 0.5rem;">
                    <p style="font-weight: 400;">DATE: <span style="text-decoration: underline; padding-inline: 0.75rem; font-size: 1.25rem;">23-FEB-2023</span></p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>