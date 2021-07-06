<template>
  <div>
    <div class="container mt-5">
      <h2>お問い合わせ</h2>
      <div class="container-box">
        <div class="row  my-3">
          <div class="col-12">
            <div class="form-group">
              <label for="user_id" class="caseinfo-title">ユーザーID</label>
              <input v-model="form.id" type="text" id="user_id" :class="{ 'fulled-status' : form.id ? 'fulled-input': '' }" class="form-control"/>
            </div>
          </div>
        </div>
        <div class="row  my-3">
          <div class="col-12">
            <div class="form-group">
              <label for="user_name" class="caseinfo-title">お名前</label>
              <input v-model="form.name" type="text" id="user_name" :class="{ 'fulled-status' : form.name ? 'fulled-input': '' }"  class="form-control"/>
            </div>
          </div>
        </div>
        <div class="row  my-3">
          <div class="col-12">
            <div class="form-group">
              <label for="user_email" class="caseinfo-title">メールアドレス</label>
              <input v-model="form.email" type="text" id="user_email" :class="{ 'fulled-status' : form.email ? 'fulled-input': '' }" class="form-control"/>
            </div>
          </div>
        </div>
        <div class="row  my-3">
          <div class="col-12">
            <div class="form-group">
              <label for="desc" class="caseinfo-title">ご意見・お問い合わせの内容</label>
              <textarea v-model="form.desc" rows="3" id="desc" :class="{ 'fulled-status' : form.desc ? 'fulled-input': '' }" class="form-control"></textarea>
            </div>
          </div>
        </div>

        <div class="row my-3">
          <div class="col-12">
            <p class="custom-p">
              【カスタマーサポートについて】<br>
              営業時間：平日10時〜17時<br>
              ※営業時間外のお問いあわせは返信に時間がかかる場合がございます<br>
              ※土日祝日にいただいたお問い合わせにつきまして、翌営業日以降のご返信となりますのであらかじめご了承ください。<br>
              ※弊社では電話対応を行っていないため、申し訳ございませんがメールでのサポートのみとさせていただきます。<br>
              ※お問い合わせいただきました内容によっては、お答えできない場合やお時間がかかる場合がございます。<br>
            </p>
          </div>
        </div>

        <div class="row">
          <div class="col-12 d-flex justify-content-center">
            <router-link :to="{ name: 'contact_thanks' }" class="btn btn-primary btn-custom-contact">
              お問い合わせ内容を送信する
            </router-link>
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

  data: () => ({
    form: new Form({
      id: '',
      name: '',
      email: '',
      desc: ''
    })
  }),
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
  margin-top: 30px;
  margin-bottom: 100px;
  line-height: 25px;
}
.custom-p{
  font-size: 13px;
}
</style>
