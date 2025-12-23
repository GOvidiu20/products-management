function save(productId) {
    const formData = new FormData();

    const name = document.getElementById('name').value;
    const price = document.getElementById('price').value;
    const availabilityDate = document.getElementById('availability_date').value;
    if (!name || !price) {
        Swal.fire({
            title: 'Error!',
            text: 'Please fill in all required fields.',
            icon: 'error',
        });
        return;
    }

    formData.append('name', name);
    formData.append('price', price);
    formData.append('description', document.getElementById('description').value);
    formData.append('in_stock', document.getElementById('in_stock').checked ? '1' : '0');

    if(availabilityDate !== '')
        formData.append('availability_date', availabilityDate);

    const imageInput    = document.getElementById('image');
    const existingImage = document.getElementById('existing_image');

    if (imageInput.files.length > 0) {
        formData.append('image_path', imageInput.files[0].name);
    } else if (existingImage) {
        formData.append('image_path', existingImage.value);
    }

    const url = productId
        ? `/${productId}/update`
        : '/store';

    fetch(url, {
        method: 'POST',
        body: formData
    })
        .then(async data => {
            if (data.ok) {
                Toastify({
                    text: "Successfully updated product!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    class: "success",
                }).showToast();

                window.location.href = '/';
            } else {
                const message = await data.text();
                Toastify({
                    text: message,
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    class: "error",
                }).showToast();
            }
        })
        .catch(error => {
            Toastify({
                text: "Failed updating product.",
                duration: 3000,
                gravity: "top",
                position: "right",
                class: "error",
            }).showToast();
        });
}

function deleteProduct(productId) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/${productId}/delete`, {
                method: 'DELETE'
            })
                .then(data => {
                    if (data.ok) {
                        Toastify({
                            text: "Successfully deleted product!",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            class: "success",
                            newWindow: true,
                        }).showToast();

                        window.location.href = '/';
                    } else {
                        Toastify({
                            text: "Failed to delete product.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            class: "error",
                        }).showToast();
                    }
                })
                .catch(error => {
                    Toastify({
                        text: error,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        class: "error",
                    }).showToast();
                });
        }
    });
}