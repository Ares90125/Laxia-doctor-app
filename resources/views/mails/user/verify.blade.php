
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja" style="background-color:#F5F8FC;width: 100%;">
<head>
  <meta name="format-detection" content="telephone=no,address=no,email=no,date=no">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="copyright" content="(C) xxxx, Inc.">
  <title>xxxx</title>
</head>
  <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family:游ゴシック,Yu Gothic,ヒラギノ角ゴ Pro,Hiragino Kaku Gothic Pro,メイリオ,Meiryo,MS Pゴシック,MS PGothic,sans-serif;width: 100%;font-size: 14px;background-color:#F5F8FC;">
  <!-- 全体 -->
  <!-- ヘッダー -->
    <table width="100%" style="border-collapse: collapse;border-spacing: 0;border: 0 none;vertical-align: top;font-size: 14px;background: #000E29;color: #3B5154;border-top-width: 5px;text-align: center">
      <tr style="font-size: 14px;"><td style="font-size: 14px;">
        <table style="margin: 0 auto;border-collapse: collapse;border-spacing: 0;border: 0 none;vertical-align: top;font-size: 14px;width: 85%;padding:54px 50px 60px 50px;">
          <tr style="font-size: 14px;">
            <td style="font-size: 14px;text-align: center">
              <p style="width: 100%;margin: 0;padding: 0;font-size: 14px;display: block;">
                <img src="#" alt="" style="width: 250px;margin: 50px 0 38px;padding: 0;border: 0 none;outline: none;line-height: 100%;text-decoration: none;vertical-align: bottom;font-size: 14px;"/>
              </p>
              <table width="100%" style="border-collapse: collapse;border-spacing: 0;border: 0 none;vertical-align: top;font-size: 14px;">
                <tr style="font-size: 14px;">
                  <td style="font-size: 14px;text-align: center"></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td></tr>
    </table>
    <!-- 中身白 -->
    <table width="100%" style="border-collapse: collapse;border-spacing: 0;border: 0 none;vertical-align: top;font-size: 14px;text-align: center;background-color:#F5F8FC;">
      <tr style="font-size: 14px;">
        <td style="font-size: 14px;">
        <table style="margin: 0 auto;border-collapse: collapse;border-spacing: 0;border: 0 none;vertical-align: top;font-size: 14px;max-width: 700px;width: 100%;background-color:#fff;margin-top: 38px;margin-bottom:40px;">
          <tr style="font-size:14px;width:100%;">
            <td style="width:10%;"></td>
              <td style="width:100%;font-size:14px;padding:54px 0 50px;" colspan="2">
                <h2 style="font-size:20px;">
                  この度は会員登録依頼をいただきまして、有り難うございます。
                </h2>
                <p align="left" style="display: block;margin:0;padding: 0;font-size: 14px;line-height:1.8;margin-top: 40px;padding-bottom:50px;text-align: left;">
                  現在は仮登録の状態です。
                  <br><br>
                  本会員登録を完了するには下記URLにアクセスしてください。</p>
                  <a href="{{ route('user.email.verify', $user->confirmation_code) }}">{{ route('user.email.verify', $user->confirmation_code) }}</a>
              </td>
            <td style="width:10%;"></td>
          </tr>
          <tr style="font-size: 14px;">
            <td rowspan="3" style="width:10%;"></td>
            <td align="left" style="font-size: 14px;text-align: left;width:50%;padding:0 0 43px;border-bottom: 1px solid #d3d3d3;">
            </td>
            <td rowspan="3" style="width:10%;"></td>
          </tr>
        </table>
    </table>
    <!-- フッター -->
    <table width="100%" style="border-collapse: collapse;border-spacing: 0;border: 0 none;vertical-align: top;font-size: 14px;background-color: #000B1D;color: #fff;text-align: center;">
      <tbody style="width: 100%;">
        <tr style="width: 100%;font-size: 14px;border-bottom: 1px solid #1A2434;">
          <td style="width: 40%;font-size: 14px;padding: 20px 0;text-align: right;"><a href="#" style="text-decoration: none;color:#fff">xxxx</a>
          </td>
          <td style="width:6%;font-size: 14px;padding: 20px 0;text-align: center;color:#1A2434;">｜
          </td>
          <td style="width: 40%;font-size: 14px;padding: 20px 0;text-align: left;">
            <a href="#" style="text-decoration: none;color:#fff">運営会社</a>
          </td>
        </tr>
        <tr style="width: 100%;font-size: 14px;">
          <td  colspan="3" style="width: 100%;font-size: 12px;padding: 20px 0;text-align: center;color:#B7B7B7;">
            ©︎ 2020 Inc.
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
