document.addEventListener("DOMContentLoaded", function () {

    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.defaults.headers.common['Content-Type'] = "application/json";

    let btnSubmit = document.querySelector('#btnSubmit');
    let gdgForm = document.querySelector('#gdgForm');
    let addVariant = document.querySelector('#addVariant');
    let variants = document.querySelector('#variants');
    let typeID = document.querySelector('#type_id');

    let productVariantTab = document.querySelector('#productVariantTab');

    let variantCount = 0;
    let variantSizeStockInfo = [];
    const sizeDivKey = "sizeDiv";
    const requiredFields = {
        name: { type: "input" },
        price: { type: "input", data_type: "price" },
        type_id: { type: "select" },
        brand_id: { type: "select" },
        category_id: { type: "select" }
    };
    const sizes = {
        1: ['xs', 's', 'm', 'l', 'xl', 'xxl', '3xl', '4xl', '5xl'],
        2: Array.from({ length: 31 }, (_, i) => i +20),
        3: ['standart']
    };

    const createElement = (tag, className = '', attrs = {}) => {
        let el =   document.createElement(tag);
        el.className = className;
        Object.entries(attrs).forEach(([key, value]) => el.setAttribute(key, value));
        return el;
    };

    const createInput = (className, id, placeholder, name, type = 'text', value = '') =>
        createElement("input", className, {id, placeholder, name, type, value});

    const createDiv = (className, id = '') => createElement('div', className, { id });

    const createLabel = (className, forAttr, textContent = '') => {
        let label = createElement('label', className, { for: forAttr});
        label.textContent = textContent;
        return label;
    };

    const createSelect = (className, id, name, options = []) => {
        let select = createElement('select', className, { id, name});
        options.forEach(opt => {
            let option = createElement('option', '', { value: opt === 'Beden Seçebilirsiniz' ? '-1' : opt});
            option.textContent = opt;
            select.appendChild(option);
        })
        return select;
    };

    btnSubmit.addEventListener('click', function () {
        let { isValid, message } = validateForm();
        if (isValid) {
            gdgForm.submit();
        } else {
            Swal.fire({
                title: 'Uyarı!',
                text : message || 'Lütfen gerekli alanları doldmehsuluz.',
                icon : 'warning'
            });
        }
    });

    addVariant.addEventListener('click', function () {
        let row = createDiv("row variant", `row-${variantCount}`);
        let row2 = createDiv('row');

        let variantDeleteDiv = createDiv('col-md-12 mb-1');
        let variantDeleteAElement = createElement("a", "btn-delete-variant btn btn-danger col-3", { href: 'javascript:void(0)', 'data-variant-id': variantCount })
        variantDeleteAElement.textContent = "Variantı Sil";
        let hr = createElement('hr', 'my-2');
        variantDeleteDiv.appendChild(variantDeleteAElement);
        variantDeleteDiv.appendChild(hr);

        let inputName = document.querySelector('#name');
        let nameSLug = generateSlug(inputName.value);

        let fields = [
            { id: 'name', label: 'Məhsul Adı', className: 'variant-product-name', colClass: "col-md-4 mb-4"},
            { id: 'variant_name', label: 'Məhsul Variant Adı', className: 'variant-name', colClass: "col-md-4 mb-4"},
            { id: 'slug', label: 'Slug', className: 'product-slug', colClass: "col-md-4 mb-4", value: nameSLug},
            { id: 'additional_price', label: 'Qiymət', className: 'additional-price-input', colClass: "col-md-6 mb-4", dataAttr: { 'data-variant-id' : variantCount }, type: "number" },
            { id: 'final_price', label: 'Son Qiymət', className: 'readonly', colClass: "col-md-6 mb-4", readonly: true, value: document.querySelector('#price').value },
            { id: 'extra_description', label: 'Ekstra Açığlama', className: '', colClass: "col-md-12 mb-4" },
            { id: 'publish_date', label: 'Yayınlanma Tarixi', className: '', colClass: "col-md-12 mb-4", date: true },
            { id: 'p_status', label: 'Aktiv olsun?', className: '', colClass: "col-md-6 mb-4", checkbox: true },
        ];

        fields.forEach(field => {
            let colDiv = createDiv(field.colClass);
            colDiv.appendChild(createLabel("form-label", `${field.id}-${variantCount}`, field.label));
            let input;
            if (field.checkbox){
                input = createInput("form-check-input " + field.className, `${field.id}-${variantCount}`, '', `variant[${variantCount}][${field.id}]`, 'checkbox');
                colDiv.appendChild(input);
            }else if (field.date){
                input = createInput("form-control " + field.className, `${field.id}-${variantCount}`, field.label, `variant[${variantCount}][${field.id}]`);
                input.setAttribute('data-input', "");
                let span = createElement('span', 'input-group-text input-group-addon', {'data-toggle' : ''});
                span.innerHTML = '<i data-feather="calendar"></i>';
                let dateDiv = createDiv('input-group flatpickr flatpickr-date');
                dateDiv.appendChild(input);
                dateDiv.appendChild(span);
                colDiv.appendChild(dateDiv);
            }else{
                input = createInput("form-control " + field.className, `${field.id}-${variantCount}`, field.label, `variant[${variantCount}][${field.id}]`, field.type || 'text', field.value || '');
                if (field.dataAttr) Object.entries(field.dataAttr).forEach(([key, value]) => input.setAttribute(key, value));
                if (field.readonly) { input.readOnly = true; input.classList.add('readonly'); }
                colDiv.appendChild(input);
            }
            row.appendChild(colDiv);
        });

        let mehsulAddSizeDiv = createDiv("row");
        let mehsulAddSizeSpan   = createElement("span", 'ms-2');
        mehsulAddSizeSpan.textContent='Bədən ölçüsü əlavə edin '
        let mehsulAddSizeiElement   = createElement("i", 'add-size', { 'data-feather': 'plus-circle'});
        let mehsulAddSizeAElement   = createElement("a", 'btn-add-size col-md-12', { href: 'javascript:void(0)', 'data-variant-id': variantCount});
        mehsulAddSizeAElement.appendChild(mehsulAddSizeiElement);
        mehsulAddSizeAElement.appendChild(mehsulAddSizeSpan);

        let mehsulAddSizeIElementImage = createElement('i', 'add-size', { 'data-feather': 'image'})
        let imageDataInputElement = createInput("form-control", `data-input-${variantCount}`, '', `image[${variantCount}][]`, 'hidden');
        let imageDataPreviewElement = createDiv('col-md-12',`data-preview-${variantCount}` );

        let mehsulAddSizeAElementImage = createElement("a", "btn btn-info btn-add-image mb-4", {href: "javascript:void(0)", 'data-variant-id': variantCount, 'data-input': "data-input-" + variantCount, 'data-preview': "data-preview-" + variantCount });
        mehsulAddSizeAElementImage.textContent = "Şəkil Əlavə Et";
        let mehsulAddSizeAElementDiv = createDiv("col-md-12");

        mehsulAddSizeAElementImage.appendChild(mehsulAddSizeIElementImage);
        mehsulAddSizeAElementDiv.appendChild(mehsulAddSizeAElementImage);

        mehsulAddSizeDiv.appendChild(mehsulAddSizeAElementDiv);
        mehsulAddSizeDiv.appendChild(imageDataInputElement);
        mehsulAddSizeDiv.appendChild(imageDataPreviewElement);
        mehsulAddSizeDiv.appendChild(mehsulAddSizeAElement);

        let mehsulAddSizeGeneralDiv = createDiv("col-md-12 p-0 mb-3", sizeDivKey + variantCount);


        row2.appendChild(variantDeleteDiv);

        row.appendChild(row2);
        row.appendChild(mehsulAddSizeDiv);
        row.appendChild(mehsulAddSizeGeneralDiv);

        let hr2 = createElement('hr', 'my-5');
        row.appendChild(hr2);

        variants.insertAdjacentElement('afterbegin', row);
        variantCount++;
        feather.replace();
        flatpickr(".flatpickr-date", {
            wrap      : true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    });

    typeID.addEventListener('change', function () {
        document.querySelectorAll(`[id^=${sizeDivKey}]`).forEach(div => div.innerHTML = "");
    });

    document.body.addEventListener('click', function (event) {
        let element = event.target;

        if (element.classList.contains('btn-delete-variant')) {
            let variantID = element.getAttribute("data-variant-id");
            let findDeleteVariantElement = document.querySelector('#row-' + variantID);
            if (findDeleteVariantElement) {
                findDeleteVariantElement.remove();
                updateVariantIndexes();
            }
        }

        if (element.classList.contains('btn-size-stock-delete')) {
            let dataSizeStockID = element.getAttribute('data-size-stock-id');
            let findSizeStockDiv = document.querySelector("#sizeStockDeleteGeneral-" + dataSizeStockID);
            if (findSizeStockDiv) {
                findSizeStockDiv.remove();
                updateSizeStockIndexes(dataSizeStockID);
            }
        }

        if (element.classList.contains('btn-add-size')) {
            btnAddSizeAction(element);
        }

        if (element.parentElement.classList.contains('btn-add-size')) {
            btnAddSizeAction(element.parentElement);
        }

        if (element.classList.contains('btn-add-image')) {
            openFileManager(element);
        }

        if (element.classList.contains("delete-variant-image")) {
            deleteVariantImage(element);
        }
    });

    document.body.addEventListener('input', function (event) {
        let element = event.target;


        checkRequireFieldsForProductVariantTab();

        if (element.classList.contains("additional-price-input"))
        {
            calculateFinalPrice(element);
        }

        if (element.id === 'name') {
            changeNameForSlug(element);
        }

        if (element.classList.contains("variant-product-name")) {
            changeVariantProductNameForSlug(element);
        }

        if (element.classList.contains("variant-name")) {
            changeVariantNameForSlug(element);
        }
    });

    document.body.addEventListener('focusout', function (event)
    {
        let element = event.target;

        if (element.classList.contains("product-slug")) {
            let slug = generateSlug(element.value);
            validateSlug(element, slug);
        }
        if (element.classList.contains("variant-product-name") || element.classList.contains("variant-name"))
        {
            let variantID = element.id.split("-")[1];
            let slugInput = document.querySelector("#slug-" + variantID);

            let slug = generateSlug(slugInput.value);
            validateSlug(element, slug);
        }
    });

    function updateVariantIndexes()
    {
        let allVariants = Array.from(document.querySelectorAll('.row.variant')).reverse();

        const attributesToUpdate = [
            { selector: '[data-variant-id]',  attr: 'data-variant-id', prefix: '' },
            { selector: '[for^="name-"]',  attr: 'for', prefix: 'name-' },
            { selector: '[id^="name-"]',  attr: 'id', prefix: 'name-', name: true },
            { selector: '[for^="variant_name-"]',  attr: 'for', prefix: 'variant_name-' },
            { selector: '[id^="variant_name-"]',  attr: 'id', prefix: 'variant_name-', name: true },
            { selector: '[for^="slug-"]',  attr: 'for', prefix: 'slug-' },
            { selector: '[id^="slug-"]',  attr: 'id', prefix: 'slug-', name: true },
            { selector: '[for^="additional_price-"]',  attr: 'for', prefix: 'additional_price-' },
            { selector: '[id^="additional_price-"]',  attr: 'id', prefix: 'additional_price-', name: true },
            { selector: '[for^="final_price-"]',  attr: 'for', prefix: 'final_price-' },
            { selector: '[id^="final_price-"]',  attr: 'id', prefix: 'final_price-', name: true },
            { selector: '[for^="extra_description-"]',  attr: 'for', prefix: 'extra_description-' },
            { selector: '[id^="extra_description-"]',  attr: 'id', prefix: 'extra_description-', name: true },
            { selector: '[for^="publish_date-"]',  attr: 'for', prefix: 'publish_date-' },
            { selector: '[id^="publish_date-"]',  attr: 'id', prefix: 'publish_date-', name: true },
            { selector: '[for^="p_status-"]',  attr: 'for', prefix: 'p_status-' },
            { selector: '[id^="p_status-"]',  attr: 'id', prefix: 'p_status-', name: true },
            { selector: '[for^="size-"]',  attr: 'for', prefix: 'size-' },
            { selector: '[id^="size-"]',  attr: 'id', prefix: 'size-', name: true },
            { selector: '[id^="sizeDiv"]',  attr: 'id', prefix: 'sizeDiv' },
            { selector: '[id^="sizeStockDeleteGeneral-"]',  attr: 'id', prefix: 'sizeStockDeleteGeneral-', special: true },
            { selector: '[for^="stock-"]',  attr: 'for', prefix: 'stock-' },
            { selector: '[id^="stock-"]',  attr: 'id', prefix: 'stock-', name: true },
            { selector: '[for^="radio-"]',  attr: 'for', prefix: 'radio-', special: true },
            { selector: '[id^="radio-"]',  attr: 'id', prefix: 'radio-', name: true, special: true },
            { selector: '[id^="data-input-"]',  attr: 'id', prefix: 'data-input-', name: "image" },

        ];
        allVariants.forEach((variant, index) => {
            variant.id = `row-${index}`;
            attributesToUpdate.forEach(({ selector, attr, prefix, name, special }) => {
                variant.querySelectorAll(selector).forEach(element => {
                    if (special && attr === 'id' && selector === '[id^="sizeStockDeleteGeneral-"]'){
                        let [_,oldVariantID, stockID] = element.getAttribute(attr).split('-');
                        element.id = `${prefix}${index}-${stockID}`;
                        element.classList.replace(`size-stock-${oldVariantID}`, `size-stock-${index}`);
                        element.querySelectorAll('[for^="size-"]').forEach(e => e.setAttribute('for', `size-${index}-${stockID}`));
                        element.querySelectorAll('[id^="size-"]').forEach(e => {
                            e.id = `size-${index}-${stockID}`;
                            e.setAttribute('name', `variant[${index}][size][${stockID}]`);
                        })
                    }else if(special && selector === '[for^="radio-"]'){
                        let [_, __, imageID] = element.getAttribute(attr).split("-");
                        element.setAttribute(attr, `${prefix}${index}-${imageID}`);
                    }else if (special && selector === '[id^="radio-"]'){
                        let [_, __, imageID] = element.getAttribute(attr).split("-");
                        element.id = `${prefix}${index}-${imageID}`;
                        element.setAttribute("name", `variant[${index}][radio]`);
                    }else{
                        element.setAttribute(attr, `${prefix}${index}`);
                        if (name) element.setAttribute('name', `${name === true ? `variant[${index}][${prefix.slice(0,-1)}]` : `${name}[${index}]` }`);
                    }
                });
            });
        });
        variantCount--;
    }
    function updateSizeStockIndexes(dataSizeStockID)
    {
        let [variantID, sizeStockID] = dataSizeStockID.split("-");
        let allSizeStock = document.querySelectorAll('.row.size-stock-' + variantID);
        allSizeStock.forEach((variant, index) => {
            let id = variantID + "-" + index;
            variant.id = "sizeStockDeleteGeneral-" + id;

            variant.querySelectorAll('[for^="size-"]').forEach(element => element.setAttribute('for', ("size-" + id)));
            variant.querySelectorAll('[id^="size-"]').forEach(element => {
                element.id = "size-" + id;
                element.setAttribute("name", "variant[" + variantID + "][size][" + index + "]")
            });
            variant.querySelectorAll('[for^="stock-"]').forEach(element =>  element.setAttribute('for', ("stock-" + id)));
            variant.querySelectorAll('[id^="stock-"]').forEach(element => {
                element.id = "stock-" + id;
                element.setAttribute("name", "variant[" + variantID + "][stock][" + index + "]")
            });
            variant.querySelectorAll('[id^="sizeStockDelete-"]').forEach(element => {
                element.id = "sizeStockDelete-" + id;
                element.setAttribute("data-size-stock-id", id);
            });
        });
    }
    function btnAddSizeAction(element)
    {
        let dataVariantID = element.getAttribute("data-variant-id");
        let sizeStock = variantSizeStockInfo[dataVariantID]?.size_stock || 0;
        let productSize = sizes[typeID.value];
        let options = ["Bədən Ölçüsü Seçəbilərsiniz", ...productSize];
        let divID = sizeDivKey + dataVariantID;
        let findDiv = document.querySelector("#" + divID);

        let mehsulSizeID = 'size-' + dataVariantID + '-' + sizeStock;
        let mehsulSizeDiv = createDiv("col-md-5 mb-4 px-3")
        let mehsulSizeLabel = createLabel("form-label", mehsulSizeID, "Bədən");

        let mehsulSizeSelect = createSelect("form-control", mehsulSizeID, `variant[${dataVariantID}][size][${sizeStock}]`, options);
        mehsulSizeDiv.appendChild(mehsulSizeLabel);
        mehsulSizeDiv.appendChild(mehsulSizeSelect);

        let mehsulStockID = 'stock-' + dataVariantID + '-' + sizeStock;
        let mehsulStockDiv = createDiv("col-md-5 mb-4 px-3")
        let mehsulStockLabel = createLabel("form-label", mehsulStockID, "Stok Sayı");
        let mehsulStockInput = createInput("form-control", mehsulStockID, 'Stok Sayı', `variant[${dataVariantID}][stock][${sizeStock}]`, 'number');

        mehsulStockDiv.appendChild(mehsulStockLabel);
        mehsulStockDiv.appendChild(mehsulStockInput);

        let generalDivID = "sizeStockDeleteGeneral-" + dataVariantID + "-" + sizeStock;
        let mehsulSizeStockGeneralDivClass = "row mx-0 size-stock-" + dataVariantID;
        let mehsulSizeStockGeneralDiv = createDiv(mehsulSizeStockGeneralDivClass, generalDivID)

        let mehsulSizeStockDeleteDiv = createDiv("col-md-2 mb-4 px-3")
        let aElementID = "sizeStockDelete-" + dataVariantID + "-" + sizeStock;
        let mehsulSizeStokDeleteAElement = createElement("a", 'btn btn-danger w-100 btn-size-stock-delete', {id: aElementID, href: 'javascript:void(0)', 'data-size-stock-id': dataVariantID + '-' + sizeStock,});
        mehsulSizeStokDeleteAElement.textContent = 'Bədən Sil';
        let mehsulSizeStokDeleteAElementLabel = createLabel("form-label d-block");
        mehsulSizeStokDeleteAElementLabel.innerHTML = '&nbsp;'
        mehsulSizeStockDeleteDiv.appendChild(mehsulSizeStokDeleteAElementLabel);
        mehsulSizeStockDeleteDiv.appendChild(mehsulSizeStokDeleteAElement);

        mehsulSizeStockGeneralDiv.appendChild(mehsulSizeDiv);
        mehsulSizeStockGeneralDiv.appendChild(mehsulStockDiv);
        mehsulSizeStockGeneralDiv.appendChild(mehsulSizeStockDeleteDiv);

        findDiv.appendChild(mehsulSizeStockGeneralDiv);

        variantSizeStockInfo[dataVariantID] = { 'size_stock' : sizeStock + 1};
    }

    function openFileManager(element)
    {
        var options = {
            filebrowserImageBrowseUrl: '/admin/gdg-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/gdg-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl     : '/admin/gdg-filemanager?type=Files',
            filebrowserUploadUrl     : '/admin/gdg-filemanager/upload?type=Files&_token=',
            type                     : "file"
        };

        var route_prefix = (options && options.prefix) ? options.prefix : '/admin/gdg-filemanager';

        var target_input = document.getElementById(element.getAttribute('data-input'));
        var target_preview = document.getElementById(element.getAttribute('data-preview'));
        let variantID = element.getAttribute('data-variant-id');
        var file_path = '';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items)
        {
            file_path = items.map(function (item)
            {
                return item.url;
            }).join(',');

            // set the value of the desired input to image url
            target_input.value = file_path;
            target_input.dispatchEvent(new Event('change'));

            // clear previous preview
            target_preview.innerHTML = '';

            // set or change the preview image src
            items.forEach(function (item, index)
            {


                let container = createDiv("image-container", `image-container-${variantID}-${index}`);
                let radio = createInput("", `radio-${variantID}-${index}`, '', `variant[${variantID}][image]`, 'radio', item.url);
                if (index === 0) radio.checked = true;

                let iElement = createElement("i", "delete-variant-image", {"data-feather": "x", "data-url": item.url, "data-variant-id": variantID, "data-image-index": index});

                let label = createLabel("", `radio-${variantID}-${index}`);

                let img = createElement("img", "", {style: "height: 5rem", 'src': item.thumb_url})

                label.appendChild(img);
                container.appendChild(radio);
                container.appendChild(label);
                container.appendChild(iElement);
                target_preview.appendChild(container);
                feather.replace();
            });
            target_preview.dispatchEvent(new Event('change'));
        }
    }
    function deleteVariantImage(element)
    {
        let variantID = element.getAttribute("data-variant-id");
        let dataUrl = element.getAttribute("data-url") + ",";
        let dataImageIndex = element.getAttribute("data-image-index");

        let dataInputFind = document.querySelector("#data-input-" + variantID);
        dataInputFind.value =  dataInputFind.value.replace(dataUrl, "");

        let findImageContainer = document.querySelector("#image-container-" + variantID + "-" + dataImageIndex);
        findImageContainer.remove();

        let dataPreview = document.querySelector('#data-preview-' + variantID);
        let imageContainers = dataPreview.querySelectorAll('.image-container');

        imageContainers.forEach((container, index) => {
            let variantIndex = variantID + "-" + index;
            container.id = "image-container-" + variantIndex;

            container.querySelectorAll('[id^="radio-"]').forEach(element => element.id = `radio-${variantIndex}`);
            container.querySelectorAll('[for^="radio-"]').forEach(element => element.setAttribute('for', ("radio-" + variantIndex)));
            container.querySelectorAll('svg').forEach(element => element.setAttribute('data-image-index', index));
        });
    }
    function calculateFinalPrice(element)
    {
        let variantID = element.getAttribute("data-variant-id");
        let findFinalPriceElement = document.querySelector("#final_price-" + variantID);
        let priceValue = document.querySelector('#price').value;
        findFinalPriceElement.value = Number(priceValue) + Number(element.value);
    }

    function checkRequireFieldsForProductVariantTab()
    {
        let requiredFieldStatus = true;

        for (const [key, properties] of Object.entries(requiredFields)) {
            let keyElement = document.querySelector('#' + key);
            let keyElementValue = keyElement.value;

            if (properties.type === 'input') {
                if (keyElementValue.length < 2) {
                    requiredFieldStatus = false;

                } else if (properties.hasOwnProperty('data_type') && properties.data_type === 'price' && (isNaN(keyElementValue) || keyElementValue < 0)) {
                    requiredFieldStatus = false;
                }
            } else if (properties.type === 'select' && keyElementValue === '-1') {
                requiredFieldStatus = false;
            }
        }

        if (requiredFieldStatus) {
            productVariantTab.removeAttribute('disabled');
        } else {
            productVariantTab.setAttribute('disabled', '');
        }
    }

    function changeNameForSlug(element)
    {
        let slugInputs = document.querySelectorAll(".product-slug");
        slugInputs.forEach(function (slugInput) {
            let variantID = slugInput.id.split("-")[1];
            let findVariantProductName = document.querySelector("#name-" + variantID).value;
            let findVariantName = document.querySelector("#variant_name-" + variantID).value;
            let slug = element.value + "-" + findVariantName;

            if (findVariantProductName.trim() !== "") {
                slug = findVariantProductName + "-" + findVariantName
            }
            slugInput.value = generateSlug(slug);
        });
    }
    function changeVariantProductNameForSlug(element)
    {
        let variantID = element.id.split("-")[1];
        let findVariantName = document.querySelector("#variant_name-" + variantID).value;
        let slugInput = document.querySelector("#slug-" + variantID);
        let nameInput = document.querySelector("#name").value.trim();
        let slug = nameInput + "-" + findVariantName;
        if (element.value.trim() !== '') {
            slug = element.value.trim() + "-" + findVariantName;
        }
        slugInput.value = generateSlug(slug);
    }

    function changeVariantNameForSlug(element)
    {
        console.log(element);
        let variantID = element.id.split("-")[1];
        let findVariantProductName = document.querySelector("#name-" + variantID).value;
        let slugInput = document.querySelector("#slug-" + variantID);
        let nameInput = document.querySelector("#name").value;
        let variantName = element.value.trim();
        let slug = nameInput + "-" + variantName;

        if (findVariantProductName.trim() !== '') {
            slug = findVariantProductName + "-" + variantName;
        }
        slugInput.value = generateSlug(slug);
    }

    function generateSlug(slug)
    {
        const turkishMap = {
            "ç": "c", "ğ": "g", "ş": "s", "ü": "u", "ö": "o", "ı": "i",
            "İ": "i", "Ç": "c", "Ğ": "g", "Ş": "s", "Ü": "u", "Ö": "o"
        };
        slug = slug.toLowerCase().replace(/[çşğüöıİÇŞĞÜÖ]/g, match => turkishMap[match]);
        slug = slug.replace(/[\s\W-]+/g, '-').replace(/^-+|-+$/g, '');
        return slug;
    }
    function validateSlug(element, slug)
    {
        let response = checkSlug(slug);
        element.classList.remove("is-invalid")
        if (response != null)
        {
            element.classList.add("is-invalid")
        }
    }

    function validateForm()
    {
        let isValid = true;
        let message = null;

        let nameInput = document.querySelector('#name');
        let priceInput = document.querySelector('#price');
        let typeSelect = document.querySelector('#type_id');
        let brandSelect = document.querySelector('#brand_id');
        let categorySelect = document.querySelector('#category_id');

        if (!nameInput.value.trim()) {
            isValid = false;
            nameInput.classList.add("is-invalid");
        } else {
            nameInput.classList.remove("is-invalid");
        }

        if (!priceInput.value.trim() || isNaN(priceInput.value) || priceInput.value < 1) {
            isValid = false;
            priceInput.classList.add("is-invalid");
        } else {
            priceInput.classList.remove("is-invalid");
        }
        if (typeSelect.value === '-1') {
            isValid = false;
            typeSelect.classList.add("is-invalid");
        } else {
            typeSelect.classList.remove("is-invalid");
        }

        if (brandSelect.value.trim() === '-1') {
            isValid = false;
            brandSelect.classList.add("is-invalid");
        } else {
            brandSelect.classList.remove("is-invalid");
        }

        if (categorySelect.value.trim() === '-1') {
            isValid = false;
            categorySelect.classList.add("is-invalid");
        } else {
            categorySelect.classList.remove("is-invalid");
        }

        let variantElements = document.querySelectorAll(".row.variant");
        if (variantElements.length < 1) {
            isValid = false;
            message = "Ən az bir variant əlavə etməlisiniz!";
        }

        variantElements.forEach((variant, index) => {
            let variantNameInput = variant.querySelector(`#variant_name-${index}`);
            let slugInput = variant.querySelector(`#slug-${index}`);
            let finalPriceInput = variant.querySelector(`#final_price-${index}`);
            let imageDataInput = variant.querySelector(`#data-input-${index}`);

            if (!variantNameInput.value.trim()) {
                isValid = false;
                variantNameInput.classList.add("is-invalid");
            } else {
                variantNameInput.classList.remove("is-invalid");
            }

            if (!slugInput.value.trim()) {
                isValid = false;
                slugInput.classList.add("is-invalid");
            } else {
                slugInput.classList.remove("is-invalid");
            }

            if (!finalPriceInput.value.trim()) {
                isValid = false;
                finalPriceInput.classList.add("is-invalid");
            } else {
                finalPriceInput.classList.remove("is-invalid");
            }

            if (!imageDataInput.value.trim()) {
                isValid = false;
                imageDataInput.classList.add("is-invalid");
                message = "Lütfen varyantlara görsel seçiniz.";
            } else {
                imageDataInput.classList.remove("is-invalid");
            }
            let sizeInputs = variant.querySelectorAll(`[id^="size-${index}"]`);
            let stockInputs = variant.querySelectorAll(`[id^="stock-${index}"]`);

            if (sizeInputs.length < 1) {
                isValid = false;
                message = "Lütfen varyantlara beden ekleyiniz.";
            }
            sizeInputs.forEach(input => {
                if (input.value === '-1') {
                    isValid = false;
                    input.classList.add("is-invalid");
                } else {
                    input.classList.remove("is-invalid");
                }
            });
            stockInputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.classList.add("is-invalid");
                } else {
                    input.classList.remove("is-invalid");
                }
            });
        });
        return {isValid, message};
    }

    function checkSlug(slug)
    {
        return axios.post(checkSlugRoute, {
            slug
        });
    }
});
