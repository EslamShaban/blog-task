<script type="text/javascript">

    function dragNdrop(event) {
        var fileName = URL.createObjectURL(event.target.files[0]);
        var preview = document.getElementById("preview");
        var previewImg = document.createElement("img");
        previewImg.setAttribute("src", fileName);
        preview.innerHTML = "";
        preview.appendChild(previewImg);
    }
    function drag() {
        document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
    }
    function drop() {
        document.getElementById('uploadFile').parentNode.className = 'dragBox';
    }

    // const validateForm = form => {

    //     const formElem = document.getElementById(form);

    //     Array.from(formElem.elements).forEach(element => {
    //         element.addEventListener('blur', event => {
    //             validateSingleFormGroup(event.srcElement.parentElement);
    //         });
    //     });

    //     formElem.addEventListener('submit', event => {
    //         event.preventDefault();
    //         validateAllFormGroup(formElem);
    //         console.log(errors);
    //     });

    //     const validationOptions = [
    //         {
    //             attribute: 'required',
    //             isValid: input => input.value.trim() !== '',
    //             errorMessage: (input, label) => `${label.textContent} is required`
    //         }
    //     ];

    //     const validateSingleFormGroup = formGroup => {

    //         const label = formGroup.querySelector('label');
    //         const input = formGroup.querySelector('input, textarea');
    //         const error = formGroup.querySelector('.error');

    //         let formGroupError = false;

    //         for (const option of validationOptions) {

    //             if (input.hasAttribute(option.attribute) && !option.isValid(input)) {

    //                 error.textContent = option.errorMessage(input, label);
    //                 input.classList.add('is-invalid');
    //                 error.classList.add('invalid-feedback');

    //                 formGroupError = true;
    //             }
    //         }

    //         if (!formGroupError) {
    //             error.textContent = '';
    //             input.classList.add('is-valid');
    //             input.classList.remove('is-invalid'); 
    //         }
    //     };

    //     const validateAllFormGroup = formToValidate => {

    //         const formGroups = Array.from(formToValidate.querySelectorAll('.form-group'));

    //         formGroups.forEach(formGroup => {

    //             validateSingleFormGroup(formGroup);

    //         });


    //     };

    // }
    // validateForm('create-post-form');
    
</script>
