<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>A Simple Responsive HTML Email</title>
        <style type="text/css">
        body {margin: 0; padding: 0; min-width: 100%!important;}
        .content {width: 100%; max-width: 600px;}  
        </style>
    </head>
    <body yahoo bgcolor="#f6f8f1">
        <table align="center" border="1" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
            <tr>
                <td align="center"  bgcolor="" style="padding: 40px 0 30px 0;">
                <h3>Loan Application</h3>
                </td>
            </tr>
            <tr>
                <td  bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                    <table  border="1" cellpadding="2" cellspacing="0" width="100%">
                        <tr>
                        <td>Name</td>
                        <td>{{$name}}</td>
                        </tr>
                        <tr>
                        <td>Codename</td>
                        <td>{{$codename}}</td>
                        </tr>
                        <tr>
                        <td>Amount</td>
                        <td>Php {{ $amount }}</td>
                        </tr>
                        <tr>
                        <td>Months to pay</td>
                        <td>{{$terms}}</td>
                        </tr>
                        <tr>
                        <td>Monthly amortization</td>
                        <td>{{$monthly_due}}</td>
                        </tr>
                        <tr>
                        <td>Date applied</td>
                        <td>{{date('Y-m-d :H:i:s')}}</td>
                        </tr>
                    </table>
                </td>
            <tr>
                <td style="padding: 30px 30px 30px 30px;">
                Click <a href="#">here</a> to review.
                </td>
            </tr>
        </table>
    </body>
</html>