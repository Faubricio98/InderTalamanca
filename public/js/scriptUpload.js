const input = document.getElementById("fileToUpload");
const preview = document.querySelector(".preview");

input.style.opacity = 0;

input.addEventListener("change", updateImageDisplay);

function updateImageDisplay() {
	while (preview.firstChild) {
		preview.removeChild(preview.firstChild);
	}

    const curFiles = input.files;
	if (curFiles.length === 0) {
		const para = document.createElement("p");
		para.textContent = "No se ha seleccionado ningún archivo";
		preview.appendChild(para);
	} else {
		const list = document.createElement("ol");
		preview.appendChild(list);

		for (const file of curFiles) {
			const listItem = document.createElement("li");
			const para = document.createElement("p");

            para.textContent = `Archivo: ${file.name}`; //, file size ${returnFileSize(file.size)}.`;
            const image = document.createElement("img");
            var nameArray = file.name.split(".");
            if (nameArray[nameArray.length - 1] == "pdf") {
                image.src = "public/img/pdf.png";
            } else {
                if (nameArray[nameArray.length - 1] == "docx") {
					image.src = "public/img/docx.png";
                } else {
                    image.src = "public/img/doc.png";
                }
            }
			listItem.appendChild(image);
			listItem.appendChild(para);

			list.appendChild(listItem);
		}
	}
}

// https://developer.mozilla.org/en-US/docs/Web/Media/Formats/Image_types
const fileTypes = [
	"image/apng",
	"image/bmp",
	"image/gif",
	"image/jpeg",
	"image/pjpeg",
	"image/png",
	"image/svg+xml",
	"image/tiff",
	"image/webp",
	`image/x-icon`,
];

function validFileType(file) {
    return fileTypes.includes(file.type);
}

function returnFileSize(number) {
	if (number < 1024) {
		return number + "bytes";
	} else if (number > 1024 && number < 1048576) {
		return (number / 1024).toFixed(1) + "KB";
	} else if (number > 1048576) {
		return (number / 1048576).toFixed(1) + "MB";
	}
}
