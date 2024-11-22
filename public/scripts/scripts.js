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
	const textarea = document.getElementById('exampleFormControlTextarea1');
	const wordCount = document.getElementById('wordCount');
	const words = textarea.value.trim().split(/\s+/).filter(Boolean); // Split by spaces and filter out empty words
	wordCount.textContent = `Word count: ${words.length}`;
}
