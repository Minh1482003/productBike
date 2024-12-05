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
    const response = await fetch('/provinces');
    const data = await response.json();
    return Object.values(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

async function getDistrict(code) {
  try {
    const response = await fetch(`/districts/${code}`);
    const data = await response.json();
    return Object.values(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

async function getWards(code) {
  try {
    const response = await fetch(`/wards/${code}`);
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
const formUserdata = document.querySelector('[form-update-address]');
if(formUserdata){

  formUserdata.addEventListener("submit", async (e) =>{
    e.preventDefault();

    const dataForm = {
      NameUD: e.target.Name.value,
      EmailUD: e.target.Email.value,
      SDTUD: e.target.Phone.value,
      provincesUD: e.target.provinces.value,
      districtUD: e.target.district.value,
      wardsUD: e.target.wards.value,
      addressUD: e.target.addressDetail.value,
    };

    // console.log(dataForm);
    // return;
    try {
      const response = await fetch("http://127.0.0.1:8000/updateUser", {
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      method: 'PATCH',
      body: JSON.stringify(dataForm)
    });

    const data = await response.json();

    // console.log(data); 

    alert(data.Alert);

    return;

    } catch (error) {
        console.error('Error:', error);
        alert('Có lỗi xảy ra');
    }
  })
}
//End update address

//Render address 
const inputGetAddressA = document.querySelector('[input-get-address]');

async function getAddress(url) {
  try {
    const response = await fetch(url);
    const data = await response.json();
    return Object.values(data);
  } catch (error) {
    console.error('Error:', error);
  }
}

const getInforAddress = async ()=> {
  if(inputGetAddressA){

    let inputGetAddress = inputGetAddressA.value;
    [provinceId, districtId, wardsId, addressDetail] = inputGetAddress.split('__');
  
    let [NameProvince, ValueProvince] = await getAddress(`https://provinces.open-api.vn/api/p/${provinceId}`);
    let [NameDistrict, ValueDistrict] = await getAddress(`https://provinces.open-api.vn/api/d/${districtId}`);
    let [NameWards, ValueWards] = await getAddress(`https://provinces.open-api.vn/api/w/${wardsId}`);

    let optionProvince = document.querySelector("[option-province]");
    optionProvince.innerHTML = NameProvince;
    optionProvince.value = ValueProvince;

    let optionDistrict = document.querySelector("[option-district]");
    optionDistrict.innerHTML = NameDistrict;
    optionDistrict.value = ValueDistrict;

    let optionWards = document.querySelector("[option-wards]");
    optionWards.innerHTML = NameWards;
    optionWards.value = ValueWards;

    let inputDetailAddress = document.querySelector("input[name='addressDetail']");
    inputDetailAddress.value = addressDetail;
  } 
}
if(inputGetAddressA){
  getInforAddress();
}

//End render address 

//Submit product rent

const submitRent = document.querySelector("[btn-submit-rent]");

if(submitRent){
  submitRent.addEventListener("click", ()=>{

    let quantity = document.querySelector("input[name='quantity-rent']").value;
    let fromSubmitRent = document.querySelector("[form-submit-rent]");
    
    fromSubmitRent.Quantity_Rent.value = quantity;
    // console.log(fromSubmitRent.action);
    fromSubmitRent.submit();
  });
}
//End product rent

//Handel time rent
const checkTypeRent = document.querySelector("input[name='checkTypeRent']");

function caculaTimeRent (startTimeRent, endTimeRent){
  const diffMs = endTimeRent - startTimeRent;

  // 1 ngày = 24 giờ = 24 * 60 * 60 * 1000 ms
  // 1 giờ = 60 phút = 60 * 60 * 1000 ms 
  // 1 phút = 60 giây = 60 * 1000 ms

  const Days = Math.floor(diffMs / (1000 * 60 * 60 * 24));
  const Hours = Math.floor((diffMs % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const Minutes = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));

  return {
    TimeStart : startTimeRent.toLocaleString('vi-VN', {
      timeZone: 'Asia/Ho_Chi_Minh',
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    }),
    TimeEnd : endTimeRent.toLocaleString('vi-VN', {
      timeZone: 'Asia/Ho_Chi_Minh',
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
      hour: '2-digit',
      minute: '2-digit',
      hour12: false
    }),
    Day: Days,
    Hour: Hours,
    Minute: Minutes
  }
}

if(checkTypeRent){
  let timeStartRent = "";
  let timeEndRent = "";
  let rental_term = "";
  let tolTalPriceRent = 0;
  
  let startTimeRent = document.querySelector("[time-start-rent]");
  let endTimeRent = document.querySelector("[time-end-rent]");

  let priceHour = document.querySelector("[price-hour-rent]").value;
  let priceDay = document.querySelector("[price-day-rent]").value;

  let quantity = document.querySelector("[quantity-rent-order]").innerHTML;
  const rentalTerm = document.querySelector("[rental-term]");
  
  let tolTalRent = document.querySelector("[tolTal-price-rent]");

  checkTypeRent.addEventListener("change", () =>{
    startTimeRent.removeAttribute("disabled");
    endTimeRent.removeAttribute("disabled");
  });

  [endTimeRent, startTimeRent].forEach((item) =>{
    item.addEventListener("change", () =>{
      if(endTimeRent.value){
        if(startTimeRent.value > endTimeRent.value){
          alert("Ngày bắt đầu thuê phải bé hơn ngày kết thúc!");
          return;
        }

        const startTime = new Date(startTimeRent.value);
        const endTime = new Date(endTimeRent.value);
    
        let resultTime = caculaTimeRent(startTime, endTime);
    
        rentalTerm.innerHTML = `${resultTime.Day} Ngày / ${resultTime.Hour} Giờ / ${resultTime.Minute} Phút`;
        rental_term = `${resultTime.Day} Ngày / ${resultTime.Hour} Giờ / ${resultTime.Minute} Phút`;

        let priceRent = 0;
        if(resultTime.Day > 0 ){
          priceRent += priceDay * resultTime.Day;
        }
        if(resultTime.Hour > 0){
          priceRent += (priceDay /24) * resultTime.Hour;
        }  
    
        priceRent *= parseInt(quantity);
        
        //Data submit
        timeStartRent = resultTime.TimeStart;
        timeEndRent = resultTime.TimeEnd;
        tolTalPriceRent = priceRent;
        //End data submit
    
        const formatVND = new Intl.NumberFormat('vi-VN', {
          currency: 'VND'
        });
    
        tolTalRent.innerHTML = formatVND.format(priceRent);
      }
     
    });
  })
  
  let btnSubmit = document.querySelector("[button-order-rent]");
  btnSubmit.addEventListener("click", ()=>{
    const formSubmit = document.querySelector("[from-submit-order-rent]");
    if(tolTalPriceRent == 0){
      alert("Vui lòng chọn thời gian thuê xe trước!");
      return;
    }
    formSubmit.timeStartRent.value = timeStartRent;
    formSubmit.timeEndRent.value = timeEndRent;
    formSubmit.ToltalPriceRent.value = tolTalPriceRent;
    formSubmit.rental_term.value = rental_term;

    formSubmit.submit();
  });
  

}
//End handel time rent
