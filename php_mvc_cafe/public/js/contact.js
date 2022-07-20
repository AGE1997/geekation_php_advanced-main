window.onload = function(){
  /*各画面オブジェクト*/
  const btnSubmit = document.getElementById('submit');
  const inputName = document.getElementById('name');
  const inputKana = document.getElementById('kana');
  const inputTel = document.getElementById('tel');
  const inputEmail = document.getElementById('email');
  const inputBody = document.getElementById('body');
  const namePattarn = /^[a-zA-Zａ-ｚＡ-Ｚぁ-んァ-ヶ一-龠]+$/u;
  const kanaPattarn = /^[ァ-ヶ一]+$/u;
  const telPattarn = /^0\d{9,10}$/;
  const emailPattarn = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/;
  
  btnSubmit.addEventListener('click', function(event) {
      let message = [];
      /*入力値チェック*/
      if(inputName.value ==""){
          message.push("氏名を入力してください。");
      }else if(inputName.value.length > 10 && !namePattarn.test(inputName.value)) {
          message.push("記号、数字を含めず10文字以内で入力してください。")
      }
      if(inputKana.value==""){
          message.push("フリガナを入力してください。");
      }else if(inputKana.value.length > 10 && !kanaPattarn.test(inputKana.value)) {
          message.push("10文字以内のカタカナで入力してください。")
      }
      if(!telPattarn.test(inputTel.value)){
        message.push("数字で入力してください。");
      }
      if(inputEmail.value==""){
          message.push("メールアドレスを入力してください。");
      }else if(!emailPattarn.test(inputEmail.value)){
          message.push("メールアドレスの形式が不正です。");
      }
      if(inputBody.value==""){
          message.push("お問い合わせ内容を入力してください。");
      }
      if(message.length > 0){
          alert(message);
          return;
      }
      alert('入力チェックOK');
  });
};
