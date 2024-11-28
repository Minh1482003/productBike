// Change quantity cart
const btnQuantitys = document.querySelectorAll('[button-quantity]');

if(btnQuantitys) {
  btnQuantitys.forEach((button) =>{
    button.addEventListener("click", ()=>{
      let divProduct =  button.closest("[div-product]"); 
      let inputQuantity = divProduct.querySelector("input[name='input-quantity']");
  
      let quantity = parseInt(inputQuantity.value);
      if(button.value == "-" && quantity > 1){
        inputQuantity.value = quantity - 1;
        quantity = inputQuantity.value;
      } else if(button.value == "+"){
        if(quantity >= 10){
          alert("Do bạn đặt số lượng lớn vui lòng liên hệ với tư vấn viên để tạo đơn!");
          return;
        }
        inputQuantity.value = quantity + 1;
        quantity = inputQuantity.value;
      }
  
      let priceOrigin = divProduct.querySelector("[price-origin]").value;
      divProduct.querySelector("input[name='Price']").value = priceOrigin * quantity;
      caculaToltal();
    });
  });
}


const checkCart = document.querySelectorAll("input[name='checkCart']");

if(checkCart){
  checkCart.forEach((item)=>{
    item.addEventListener("change", ()=>{
      caculaToltal();
    })
  });
}

function caculaToltal () {
  const checkCart = document.querySelectorAll("input[name='checkCart']:checked");
  let toltalPrice = 0;
  checkCart.forEach((item) => {
    let valuePrice =  item.closest("[div-product]").querySelector("input[name='Price']").value;
    toltalPrice += parseInt(valuePrice);
  });
  // console.log(toltalPrice);
  
  document.querySelector("input[name='toltal_price']").value = toltalPrice;
}

// End change quantity cart



// Adress checkout

async function getProvinces() {
  try {
    const response = await fetch('http://127.0.0.1:8000/provinces');
    const data = await response.json();
    return Object.values(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

async function getDistrict(code) {
  try {
    const response = await fetch(`http://127.0.0.1:8000/districts/${code}`);
    const data = await response.json();
    return Object.values(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

async function getWards(code) {
  try {
    const response = await fetch(`http://127.0.0.1:8000/wards/${code}`);
    const data = await response.json();
    return Object.values(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

//Thêm option tỉnh thành
let selectProvince = document.querySelector("#province");
if(selectProvince) {
  selectProvince.addEventListener("click", async ()=>{
    let arrProvinces = await getProvinces();
  
    arrProvinces.forEach((item) => {
      let option = document.createElement("option");
      option.value = item.code;
      option.text = item.name;

      selectProvince.add(option);
    });
  });

  //Thêm option quận huyện
  selectProvince.addEventListener("change", async () => {
    const codeProvince = selectProvince.value;

    let districts = await getDistrict(codeProvince);
    let arrDistricts = Object.values(districts);
    
    let selectDistrict = document.querySelector("#district");
    if(selectDistrict){
      selectDistrict.innerHTML = "<option>---</option>";
      selectDistrict.removeAttribute('disabled');
    
      arrDistricts.forEach((item)=>{
        let option = document.createElement("option");
        option.value = item.code;
        option.text = item.name;
  
        selectDistrict.add(option);
      });

      selectDistrict.addEventListener("change", async () =>{
        let codeWard = selectDistrict.value;
  
        let wards = await getWards(codeWard);
        let arrWards = Object.values(wards);
        let selectWard = document.querySelector("#wards ");
        if(selectWard) {
          selectWard.innerHTML = "<option>---</option>";
          selectWard.removeAttribute('disabled');

          arrWards.forEach((item)=>{
            let option = document.createElement("option");
            option.value = item.code;
            option.text = item.name;
      
            selectWard.add(option);
          });

        }
      });
      
    }
  });
}

// End checkout

// Handle product cart
const submitCart = document.querySelector("[btn-submit-cart]");
if(submitCart){
  submitCart.addEventListener("click", ()=>{
    const checkCart = document.querySelectorAll("input[name='checkCart']:checked");
    
    let arrData = [];
    checkCart.forEach((item) => {
      let divContai =  item.closest("[div-product]");

      let idSP =  divContai.querySelector("input[name='id-product']").value;
      let image = divContai.querySelector("img[name='image-cart']").src;
      let quantity = divContai.querySelector("input[name='input-quantity']").value;
      let nameProduct = divContai.querySelector("span[name='name-cart']").innerHTML;
      let valuePrice = divContai.querySelector("input[name='Price']").value;

      arrData.push(`${idSP}__${image}__${quantity}__${nameProduct}__${valuePrice}`);
      
    });
    
    let toltalPrice = document.querySelector("input[name='toltal_price']").value;
    const formSubmit = document.querySelector("[from-submit-cart]");
    formSubmit.toltalCart.value = toltalPrice;
    formSubmit.data.value = arrData.join(", ");
    
    formSubmit.submit();
  });
}

// End handle product cart

//Submit checkout
const btnCheckout = document.querySelector("[button-order]");

if(btnCheckout){
  btnCheckout.addEventListener("click", () =>{
    const formSubmit = document.querySelector("[from-submit-checkout]");
    formSubmit.submit();
  });
}

//End Submit checkout

//Update address
document.querySelector('[form-update-address]').addEventListener('submit', async (e) => {
  e.preventDefault();
  const formData = new FormData(e.target);

  try {
    const response = await fetch("http://127.0.0.1:8000/updateUser", {
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    method: 'PATCH',
    body: formData
  });

  const data = await response.json();

  if (data.success) {
      alert(data.message);
      console.log(data.data);
  } else {
      alert('Cập nhật thất bại');
  }
  } catch (error) {
      console.error('Error:', error);
      alert('Có lỗi xảy ra');
  }
});

//End update address

