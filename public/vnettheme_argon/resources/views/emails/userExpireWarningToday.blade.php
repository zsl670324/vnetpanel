<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>{{\App\Components\Helpers::systemConfig()['website_name']}}</title>
</head>
<body style="margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td style="padding: 10px 0 30px 0;">
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
                   style="border: 1px solid #cccccc; border-collapse: collapse;">
                <tr>
                    <td align="center" bgcolor="#ff8f00"
                        style="padding: 20px 0 20px 0; color: #FFFFFF; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                        账号过期提醒
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
                                    <b>你好，</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                    <p>您的账号将于今天晚上【24:00】过期，为了确保您可以继续使用我们的服务，请及时续费或者购买服务。详情见网站：{{\App\Components\Helpers::systemConfig()['website_url']}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;">
                                    <a href="{{\App\Components\Helpers::systemConfig()['website_url']}}"
                                       style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #fff; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #ff8f00; margin: 0; border-color: #ff8f00; border-style: solid; border-width: 8px 20px;">
                                        登录网站
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #757575; vertical-align: top; margin: 0; padding: 0 0 20px;">
                                    (本邮件由系统自动发出，请勿直接回复！)
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ff8f00" style="padding: 20px 20px 20px 20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;"
                                    width="75%">
                                    &copy; {{date("Y")}}  <a href="{{\App\Components\Helpers::systemConfig()['website_url']}}" style="color: #ffffff;"><font color="#ffffff">{{\App\Components\Helpers::systemConfig()['website_name']}}</font></a>
                                </td>
                                <td align="right" width="25%">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                <a href="{{\App\Components\Helpers::systemConfig()['website_url']}}" style="color: #ffffff;">
                                                    {{trans('home.home')}}
                                                </a>
                                            </td>
                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
                                                <a href="{{\App\Components\Helpers::systemConfig()['website_url']}}/tutorials" style="color: #ffffff;">
                                                    {{trans('home.tutorials')}}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>