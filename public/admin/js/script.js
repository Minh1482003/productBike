//Button Status
const buttonStatus = document.querySelectorAll("[button-status]");
if (buttonStatus.length > 0) {
  let url = new URL(window.location.href);
  // console.log(url.href);
  buttonStatus.forEach((button) => {
    button.addEventListener("click", () => {
      const status = button.getAttribute("button-status");
      // console.log(status);
      if (status) {
        url.searchParams.set("status", status);
      } else {
        url.searchParams.delete("status")
      }
      window.location.href = url.href
    });
  });
}
// End button Status


// Show Alert
const showAlert = document.querySelector("[show-alert]");
if (showAlert) {
  const time = parseInt(showAlert.getAttribute("data-time"));
  setTimeout(() => {
    showAlert.classList.add("alert-hidden");
  }, time);

  const closeAlert = showAlert.querySelector("[close-alert]");
  closeAlert.addEventListener("click", () => {
    showAlert.classList.add("alert-hidden");
  });
}
// End Show Alert

// Button-change-status
const buttonsChangeStatus = document.querySelectorAll("[button-change-status]");
if (buttonsChangeStatus.length > 0) {
  const formChangeStatus = document.querySelector("[form-change-status]");
  const path = formChangeStatus.getAttribute("data-path");

  buttonsChangeStatus.forEach(button => {
    button.addEventListener("click", () => {
      const statusCurrent = button.getAttribute("data-status");
      const id = button.getAttribute("data-id");
      // console.log(id);
      const statusChange = statusCurrent == "active" ? "inactive" : "active";

      const action = `${path}/${statusChange}/${id}`;

      formChangeStatus.action = action;
      // console.log(action);
      formChangeStatus.submit();
    });
  });
}
// End button-change-status

// Pagination
const buttonsPagination = document.querySelectorAll("[button-pagination]");
if (buttonsPagination.length > 0) {
  let url = new URL(window.location.href);

  buttonsPagination.forEach(button => {
    button.addEventListener("click", () => {
      const page = button.getAttribute("button-pagination");

      url.searchParams.set("page", page);

      window.location.href = url.href;
    });
  });
}
// End Pagination

// Sort
const sort = document.querySelector("[sort]");
if (sort) {
  let url = new URL(window.location.href);

  const sortSelect = sort.querySelector("[sort-select]");
  const sortClear = sort.querySelector("[sort-clear]");

  // Sắp xếp
  sortSelect.addEventListener("change", () => {
    const [sortKey, sortValue] = sortSelect.value.split("-");

    url.searchParams.set("sortKey", sortKey);
    url.searchParams.set("sortValue", sortValue);

    window.location.href = url.href;
  });

  // Xóa sắp xếp
  sortClear.addEventListener("click", () => {
    url.searchParams.delete("sortKey");
    url.searchParams.delete("sortValue");

    window.location.href = url.href;
  });

  // Thêm selected cho option
  const sortKey = url.searchParams.get("sortKey");
  const sortValue = url.searchParams.get("sortValue");

  if (sortKey && sortValue) {
    const string = `${sortKey}-${sortValue}`;
    const optionSelected = sortSelect.querySelector(`option[value="${string}"]`);
    optionSelected.selected = true;
    // optionSelected.setAttribute("selected", true);
  }
}
// End Sort

// checkbox-multi
const checkboxMulti = document.querySelector("[checkbox-multi]");

if(checkboxMulti) {
  const inputCheckAll = checkboxMulti.querySelector("input[name='checkall']");
  const inputsId = checkboxMulti.querySelectorAll("input[name='id']");

  inputCheckAll.addEventListener("click", () => {
    if(inputCheckAll.checked) {
      inputsId.forEach(input => {
        input.checked = true;
      });
    } else {
      inputsId.forEach(input => {
        input.checked = false;
      });
    }
  });

  inputsId.forEach(input => {
    input.addEventListener("click", () => {
      const countChecked = checkboxMulti.querySelectorAll("input[name='id']:checked").length;

      if(countChecked == inputsId.length) {
        inputCheckAll.checked = true;
      } else {
        inputCheckAll.checked = false;
      }
    });
  });
}
// End checkbox-multi

// form-change-multi
const formChangeMulti = document.querySelector("[form-change-multi]");
if (formChangeMulti) {
  formChangeMulti.addEventListener("submit", (e) => {
    e.preventDefault();

    const inputsChecked = document.querySelectorAll("input[name='id']:checked");

    const typeChange = e.target.elements.type.value;  // Kiểu loại muốn thay đổi

    if (typeChange == "delete") {
      const isConfirm = confirm("Bạn có chắc muốn xóa những sản phẩm đã chọn không ?");
      if (!isConfirm) return;
    }

    if (inputsChecked.length > 0) {
      const ids = [];
      const inputIds = document.querySelector("input[name='ids']");
      inputsChecked.forEach(input => {
        const id = input.value;

        if (typeChange == "change-position") {
          const position = input.closest("tr").querySelector("input[name='position']").value;

          ids.push(`${id}-${position}`);
        }
        else ids.push(id);
      });

      inputIds.value = ids.join(", ");
      formChangeMulti.submit();
    } else {
      alert("Vui lòng chọn ít nhất một bản ghi!");
    }
  });
}
// End form-change-multi

// Delete Item
const buttonsDelete = document.querySelectorAll("[button-delete]");
if (buttonsDelete.length > 0) {
  const formDeleteItem = document.querySelector("[form-delete-item]");
  const path = formDeleteItem.getAttribute("data-path");

  buttonsDelete.forEach(button => {
    button.addEventListener("click", () => {
      const isConfirm = confirm("Bạn có chắc muốn xóa bản ghi này?");

      if (isConfirm) {
        const id = button.getAttribute("data-id");

        const action = `${path}/${id}`;

        formDeleteItem.action = action;

        // console.log(action);
        formDeleteItem.submit();
      }
    });
  });
}
// Delete Item

// Preview Image
const uploadImage = document.querySelector("[upload-image]");
if (uploadImage) {
  const uploadImageInput = uploadImage.querySelector("[upload-image-input]");
  const uploadImagePreview = uploadImage.querySelector("[upload-image-preview]");

  uploadImageInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    // console.log(file);
    if (file) {
      uploadImagePreview.src = URL.createObjectURL(file);
    }
    else uploadImagePreview.src = "";
  });
}
// End Preview Image

// Hình thức sản phẩm
const inputBuyOrRent = document.querySelectorAll("input[name='Buy_or_rent']");

const listPrice = document.querySelectorAll("[inputPrice]");

inputBuyOrRent.forEach((item) => {
  item.addEventListener('change', function () {
    if (item.value == 'rent') {
      listPrice[0].classList.add('d-none');
      listPrice[1].classList.remove('d-none');
      listPrice[2].classList.remove('d-none');
    } else if(item.value == 'buy') {
      listPrice[0].classList.remove('d-none');
      listPrice[1].classList.add('d-none');
      listPrice[2].classList.add('d-none');
    }
    else {
      listPrice[0].classList.remove('d-none');
      listPrice[1].classList.remove('d-none');
      listPrice[2].classList.remove('d-none');
    }
  });
});
// End hình thức sản phẩm

//Lưu lại vị trí lưu vào sessionStorage khi cuộn
window.addEventListener('scroll', function() {
  sessionStorage.setItem('scrollPosition', window.pageYOffset);
});

// Khôi phục lại vị trí cuộn
window.addEventListener('DOMContentLoaded', function() {
  var scrollPosition = sessionStorage.getItem('scrollPosition');
  if (scrollPosition) {
    window.scrollTo(0, scrollPosition);
  }
});

const optionQuantity = document.querySelector("[slect-quantity]");

if(optionQuantity) {
  let url = new URL(window.location.href);
  optionQuantity.addEventListener("change", (e) => {
    url.searchParams.set("Quantity", e.target.value);

    window.location.href = url.href;
  });
}

//Provide role
const selectRolesUser = document.querySelectorAll('select[name="Provide_Permission"]');

if(selectRolesUser){
  const formProvide = document.querySelector("[form-provide-role");
  
  selectRolesUser.forEach(select =>{
    select.addEventListener("change", () =>{
      const isConfirm = confirm("Bạn có chắc muốn cấp quyền cho người này?");

      if (isConfirm) {
        const value = select.value;
        const id = select.getAttribute("id-user");

        const userIdInput = formProvide.querySelector('input[name="id_user"]');
        const roleIdInput = formProvide.querySelector('input[name="id_role"]');
        
        userIdInput.value = id
        roleIdInput.value = value;

        // console.log(action);
        formProvide.submit();
      }
    })
  })
}
//End Provide role
