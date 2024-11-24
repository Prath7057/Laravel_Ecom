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
    const textarea = document.getElementById("exampleFormControlTextarea1");
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

    fetch("/addInputTypeFile", {
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
            let deleteInputTypeFile = document.querySelectorAll('.deleteInputTypeFile');
            deleteInputTypeFile.forEach(element => {
                element.style.visibility = 'hidden';
            });
            //
            let newDiv = document.getElementById("inputTypeFileDiv" + (inputTypeFileCount - 1));
            document.getElementById("inputTypeFileCount").value = inputTypeFileCount;
            let responseTextArr = responseText.split("^");
            newDiv.innerHTML = responseTextArr[1];
            if (inputTypeFileCount >= responseTextArr[0]) {
                document.getElementById("addMoreButton").style.visibility = "hidden";
            }
        })
        .catch((error) => console.error("Error:", error));
}
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("inputTypeFileCount").value = 1;
});
//
function deleteInputTypeFile(inputTypeFileCount) {
    inputTypeFileCount--;
    document.getElementById("addMoreButton").style.visibility = "visible";
    document.getElementById("inputTypeFileDiv"+inputTypeFileCount).innerHTML = ''; 
    if (inputTypeFileCount > 1) {
        document.getElementById("deleteButton"+inputTypeFileCount).style.visibility = "visible";
    }  
    document.getElementById("inputTypeFileCount").value = inputTypeFileCount;
}
