// formを取得
const contactForm = document.forms.zipcloud;
// formのpostcodeに郵便番号を入力したら関数を実行する
contactForm.postcode.addEventListener('input', e => {
  // zipcloud apiを使って、郵便番号の住所データを取得。
    fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${e.target.value}`)
    // 取得したデータをjson形式で読み込み。
    .then(response => response.json())
    // 取得したデータを出力
    .then(data => {
        contactForm.prefecture.value = data.results[0].address1;
        contactForm.city.value = data.results[0].address2;
        contactForm.town.value = data.results[0].address3;
    })
    .catch(error => console.log(error))
})