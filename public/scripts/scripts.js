const menuLinks = document.querySelectorAll(".nav-link");

menuLinks.forEach((link) => {
    link.addEventListener("click", () => {
        menuLinks.forEach((link) => {
            link.classList.remove("is-active");
        });
        link.classList.add("is-active");
    });
});

function updateWordCount() {
    const textarea = document.getElementById("prod_desc");
    const wordCount = document.getElementById("wordCount");
    const words = textarea.value.trim().split(/\s+/).filter(Boolean);
    wordCount.textContent = `Word count: ${words.length}`;
}

function addInputTypeFile(inputTypeFileCount1) {
    let inputTypeFileCount = inputTypeFileCount1;
    inputTypeFileCount++;
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    fetch("addInputTypeFile", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            inputTypeFileCount: inputTypeFileCount,
        }),
    })
        .then((response) => response.text())
        .then((responseText) => {
            //
            let responseTextArr = responseText.split("^");
            if (inputTypeFileCount > responseTextArr[0]) {
                document.getElementById("addMoreButton").style.visibility =
                    "hidden";
                alert("You Can add only " + responseTextArr[0] + " Images");
                return;
            }
            //
            let deleteInputTypeFile = document.querySelectorAll(
                ".deleteInputTypeFile"
            );
            deleteInputTypeFile.forEach((element) => {
                element.style.visibility = "hidden";
            });
            //
            let newDiv = document.getElementById(
                "inputTypeFileDiv" + (inputTypeFileCount - 1)
            );
            document.getElementById("inputTypeFileCount").value =
                inputTypeFileCount;
            if (inputTypeFileCount >= responseTextArr[0]) {
                document.getElementById("addMoreButton").style.visibility =
                    "hidden";
            }
            newDiv.innerHTML = responseTextArr[1];
        })
        .catch((error) => console.error("Error:", error));
}
//
document.addEventListener("DOMContentLoaded", function () {
    if (document.getElementById("inputTypeFileCount") != null)
        if (document.getElementById("secure_prod_id") != null) {
            if (document.getElementById("secure_prod_id").value == "") {
                document.getElementById("inputTypeFileCount").value = 1;
            }
        }
});
//
function deleteInputTypeFile(inputTypeFileCount) {
    inputTypeFileCount--;
    document.getElementById("addMoreButton").style.visibility = "visible";
    document.getElementById("inputTypeFileDiv" + inputTypeFileCount).innerHTML =
        "";
    document.getElementById("inputTypeFileCount").value = inputTypeFileCount;
    while (
        inputTypeFileCount > 1 &&
        document.getElementById("deleteButton" + inputTypeFileCount) != null
    ) {
        document.getElementById(
            "deleteButton" + inputTypeFileCount
        ).style.visibility = "visible";
        break;
    }
}
function previewImage(imageSrc) {
    if (document.getElementById("isImageOpen").value == "0") {
        const imagePreview = document.getElementById("imagePreview");
        imagePreview.src = imageSrc;
        document.getElementById("isImageOpen").value = "1";
        const previewDiv = document.getElementById("imagePreviewDiv");
        previewDiv.style.display = "block";
    } else {
        let previewDiv = document.getElementById("imagePreviewDiv");
        document.getElementById("isImageOpen").value = "0";
        previewDiv.style.display = "none";
    }
}
//start code for image zoom code
function imageZoom(imgID, resultID) {
    let mainResponce = document.querySelectorAll(".mainResponce");
    mainResponce.forEach((ee) => {
        ee.style.display = "none";
    });
    var img, lens, result, cx, cy;
    img = document.getElementById(imgID);
    result = document.getElementById(resultID);
    var lens = img.parentElement.querySelector(".img-zoom-lens");
    if (!lens) {
        lens = document.createElement("DIV");
        lens.setAttribute("class", "img-zoom-lens");
        img.parentElement.insertBefore(lens, img);
    }
    cx = result.offsetWidth / lens.offsetWidth;
    cy = result.offsetHeight / lens.offsetHeight;
    result.style.backgroundImage = "url('" + img.src + "')";
    result.style.backgroundSize =
        img.width * cx + "px " + img.height * cy + "px";
    lens.addEventListener("mousemove", moveLens);
    img.addEventListener("mousemove", moveLens);
    lens.addEventListener("touchmove", moveLens);
    img.addEventListener("touchmove", moveLens);

    function moveLens(e) {
        var pos, x, y;
        e.preventDefault();
        pos = getCursorPos(e);
        x = pos.x - lens.offsetWidth / 2;
        y = pos.y - lens.offsetHeight / 2;
        if (x > img.width - lens.offsetWidth) {
            x = img.width - lens.offsetWidth;
        }
        if (x < 0) {
            x = 0;
        }
        if (y > img.height - lens.offsetHeight) {
            y = img.height - lens.offsetHeight;
        }
        if (y < 0) {
            y = 0;
        }
        lens.style.left = x + "px";
        lens.style.top = y + "px";
        result.style.backgroundPosition = "-" + x * cx + "px -" + y * cy + "px";
    }
    function getCursorPos(e) {
        var a,
            x = 0,
            y = 0;
        e = e || window.event;
        a = img.getBoundingClientRect();
        x = e.pageX - a.left;
        y = e.pageY - a.top;
        x = x - window.pageXOffset;
        y = y - window.pageYOffset;
        return { x: x, y: y };
    }
}
//end code for image zoom code
function removeImageZoom() {
    const lensElement = document.querySelector(".img-zoom-lens");
    if (lensElement) {
        lensElement.remove();
        let mainResponce = document.querySelectorAll(".mainResponce");
        mainResponce.forEach((ee) => {
            ee.style.display = "block";
        });
        const resultElement = document.getElementById("imageZoomResultDiv");
        if (resultElement) {
            resultElement.style.backgroundImage = "";
            resultElement.style.backgroundSize = "";
        }
    }
}
//
function validateSignUpForm() {
    let username = document.getElementById("user_username").value;
    let email = document.getElementById("user_email").value;
    let password = document.getElementById("user_password").value;
    let cpassword = document.getElementById("cpassword").value;
    //
    if (!username) {
        document.getElementById("username-error").innerHTML =
            "The Username field is required.";
        document.getElementById("user_username").focus();
        return false;
    }
    if (!email) {
        document.getElementById("email-error").innerHTML =
            "The Email field is required.";
        document.getElementById("user_email").focus();
        return false;
    }
    if (!password) {
        document.getElementById("password-error").innerHTML =
            "The Password field is required.";
        document.getElementById("user_password").focus();
        return false;
    }
    if (!cpassword) {
        document.getElementById("cpassword-error").innerHTML =
            "The Confirm Password field is required.";
        document.getElementById("cpassword").focus();
        return false;
    }
    return true;
}
//
function initializeInputFields() {
    const inputFields = document.querySelectorAll("input, button");
    //
    inputFields.forEach((field) => {
        
        field.addEventListener("keydown", handleKeyboardNavigation);
    });
    //
    function handleKeyboardNavigation(event) {
        const currentField = event.target;
        const currentIndex = Array.from(inputFields).indexOf(currentField);
        if (event.key === "Enter" && currentField.type != 'submit') {
            event.preventDefault();
            const nextField = inputFields[currentIndex + 1];
            if (nextField) {
                nextField.focus();
            }
        }
        if (event.key === "Backspace" && currentField.value.length === 0) {
            const previousField = inputFields[currentIndex - 1];
            if (previousField) {
                previousField.focus();
            }
        }
    }
}