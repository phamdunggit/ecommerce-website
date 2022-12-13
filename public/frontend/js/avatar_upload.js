const elInputFile = document.querySelector("#avatarUpload");


const handleInputChange = (e) => {
  const file = e.target.files[0];

  if (file) {
    // Render original image
    const reader = new FileReader();
    reader.readAsDataURL(file);

    // Render resized image with Crop
    ResizeImage(file, 240, 240).then((canvas) => {
    //   eloutput1.src = canvas.toDataURL(file);
    data={
        'imageUrl':canvas.toDataURL(file.type),
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "POST",
        url: "/add-avatar",
        data: data,
        success: function (response) {
            console.log(response);
            window.location.reload();
            
        }
    });
    });

    // Render resized image without Crop
  }
};

elInputFile.addEventListener("change", handleInputChange);

function ResizeImage(file, width = 400, height = 400, crop = true) {
  return new Promise((resolve, reject) => {
    if (!file) {
      return reject();
    }

    const reader = new FileReader();

    reader.onload = function (e) {
      const img = document.createElement("img");

      img.src = e.target.result;
      img.onload = () => {
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);

        const ratio = img.width / img.height;

        let targetWidth = img.width;
        let targetHeight = img.height;
        let offsetLeft = 0;
        let offsetTop = 0;

        if (ratio > 1) {
          if (crop) {
            targetHeight = height;
            targetWidth = targetHeight * ratio;
            offsetLeft = -((targetWidth - width) / 2);
            offsetTop = 0;
          } else {
            targetWidth = width;
            targetHeight = width / ratio;
          }
        } else {
          if (crop) {
            targetWidth = width;
            targetHeight = targetWidth / ratio;
            offsetLeft = 0;
            offsetTop = -((targetHeight - height) / 2);
          } else {
            targetHeight = height;
            targetWidth = height * ratio;
          }
        }

        canvas.width = crop ? width : targetWidth;
        canvas.height = crop ? height : targetHeight;

        ctx.drawImage(img, offsetLeft, offsetTop, targetWidth, targetHeight);

        resolve(canvas);
      };
    };

     reader.readAsDataURL(file);
  });
}