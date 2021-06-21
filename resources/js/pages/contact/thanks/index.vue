<template>
  <div>
    <h2 class="title-contact-thanks">お問い合わせ完了</h2>
    <div class="container mt-5 d-flex justify-content-center">
      <div class="container-box">
        <div class="row my-3">
          <div class="col-12">
            <p class="custom-p">
              ご記入していただきました情報は無事送信されました。<br>
              お問い合わせ内容につきまして、担当者が確認しましてご返答させていただきますので、<br>
              今しばらくお待ちくださいませ。<br>
              1週間経ちましてもご連絡がない場合は、記入されたメールアドレスが違っている可能性がございます。申し訳ございませんが、再度ご連絡をお願いします。<br>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'basic',

  middleware: 'guest',

}
</script>

<style>
h2{
  font-size: 24px;
  font-weight: bold;

}
h3{
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 20px;
  margin-top: 45px;
}
h4{
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
  margin-top: 10px;
}
.container{
  font-size: 16px;
}
.container-box{
  background-color: white;
  padding: 70px 200px;
  margin-top: 0px;
  margin-bottom: 100px;
  line-height: 25px;
  width: 1000px;
}
.custom-p{
  font-size: 16px;
  line-height: 33px;
}

.title-contact-thanks{
  margin-top: 100px;
  text-align: center;
  font-size: 35px;
  letter-spacing: 6px;
}
</style>
