document.addEventListener("DOMContentLoaded", function ()
{
    let addVariant = document.querySelector('#addVariant');
    let variants = document.querySelector('#variants');
    let typeID = document.querySelector('#type_id');
    let productVariantTab = document.querySelector('#productVariantTab');
    let variantCount = 0;
    let variantSizeStockInfo = [];
    const sizeDivKey = "sizeDiv";
    const requiredFields = {
        name: {
            type: "input"
        },
        price: {
            type: "input",
            data_type: "price",
        },
        type_id:{
            type: "select"
        },
        brand_id:{
            type: "select"
        },
        category_id:{
            type: "select"
        },
    };
    let dressSize = ['xs', 's', 'm', 'l', 'xl', 'xxl', '3xl', '4xl', '5xl'];
    let shoesSize = shoesNumberGenerate();
    let standartSize = ['standart'];

    let sizes = {
        1: dressSize,
        2: shoesSize,
        3: standartSize
    };

    addVariant.addEventListener('click', function ()
    {
        let row = createDiv("row variant", "row-" + variantCount);
        let row2 = createDiv("row");

        let variantDeleteDiv = createDiv("col-md-12 mb-1")
        let variantDeleteAElement = createAElement(null, 'btn-delete-variant btn btn-danger col-3', 'javascript:void(0)', ['data-variant-id', variantCount], 'Variantı Sil');


        let mehsulAdiID = 'name-' + variantCount;
        let mehsulAdiNameAttr = 'variant[' + variantCount + '][name]';
        let mehsulAdiDiv = createDiv("col-md-4 mb-4")
        let mehsulAdiLabel = createLabel("form-label", mehsulAdiID, "Məhsul Adı");
        let mehsulAdiInput = createInput("form-control", mehsulAdiID, "off", "Məhsul Adı", mehsulAdiNameAttr);

        mehsulAdiDiv.appendChild(mehsulAdiLabel);
        mehsulAdiDiv.appendChild(mehsulAdiInput);

        let mehsulVariantNameID = 'variant_name-' + variantCount;
        let mehsulVariantNameAttr = 'variant[' + variantCount + '][variant_name]';
        let mehsulVariantNameDiv = createDiv("col-md-4 mb-4")
        let mehsulVariantNameLabel = createLabel("form-label", mehsulVariantNameID, "Məhsul Variant Adı");
        let mehsulVariantNameInput = createInput("form-control", mehsulVariantNameID, "off", "Məhsul Variant Adı", mehsulVariantNameAttr);

        mehsulVariantNameDiv.appendChild(mehsulVariantNameLabel);
        mehsulVariantNameDiv.appendChild(mehsulVariantNameInput);

        let mehsulSlugID = 'slug-' + variantCount;
        let mehsulSlugNameAttr = 'variant[' + variantCount + '][slug]';
        let mehsulSlugDiv = createDiv("col-md-4 mb-4")
        let mehsulSlugLabel = createLabel("form-label", mehsulSlugID, "Slug");
        let mehsulSlugInput = createInput("form-control", mehsulSlugID, "off", "Slug", mehsulSlugNameAttr);

        mehsulSlugDiv.appendChild(mehsulSlugLabel);
        mehsulSlugDiv.appendChild(mehsulSlugInput);

        let mehsulAdditionalPriceID = 'additional_price-' + variantCount;
        let mehsulAdditionalPriceNameAttr = 'variant[' + variantCount + '][additional_price]';
        let mehsulAdditionalPriceDiv = createDiv("col-md-6 mb-4")
        let mehsulAdditionalPriceLabel = createLabel("form-label", mehsulAdditionalPriceID, "Qiymət");
        let mehsulAdditionalPriceInput = createInput("form-control", mehsulAdditionalPriceID, "off", "Qiymət", mehsulAdditionalPriceNameAttr);
        mehsulAdditionalPriceDiv.appendChild(mehsulAdditionalPriceLabel);
        mehsulAdditionalPriceDiv.appendChild(mehsulAdditionalPriceInput);

        let mehsulFinalPriceID = 'final_price-' + variantCount;
        let mehsulFinalPriceNameAttr = 'variant[' + variantCount + '][final_price]';
        let mehsulFinalPriceDiv = createDiv("col-md-6 mb-4")
        let mehsulFinalPriceLabel = createLabel("form-label", mehsulFinalPriceID, "Son Qiymət");
        let mehsulFinalPriceInput = createInput("form-control", mehsulFinalPriceID, "off", "Son Qiymət", mehsulFinalPriceNameAttr);
        mehsulFinalPriceDiv.appendChild(mehsulFinalPriceLabel);
        mehsulFinalPriceDiv.appendChild(mehsulFinalPriceInput);

        let mehsulExtraDescriptionID = 'extra_description-' + variantCount;
        let mehsulExtraDescriptionNameAttr = 'variant[' + variantCount + '][extra_description]';
        let mehsulExtraDescriptionDiv = createDiv("col-md-12 mb-4")
        let mehsulExtraDescriptionLabel = createLabel("form-label", mehsulExtraDescriptionID, "Ekstra Açığlama");
        let mehsulExtraDescriptionInput = createInput("form-control", mehsulExtraDescriptionID, "off", "Ekstra Açığlama", mehsulExtraDescriptionNameAttr);
        mehsulExtraDescriptionDiv.appendChild(mehsulExtraDescriptionLabel);
        mehsulExtraDescriptionDiv.appendChild(mehsulExtraDescriptionInput);


        let mehsulPublishDateID = 'publish_date-' + variantCount;
        let mehsulPublishDateNameAttr = 'variant[' + variantCount + '][publish_date]';
        let mehsulPublishDateDiv = createDiv("col-md-12 mb-4");
        let mehsulPublishDateDiv2 = createDiv("input-group flatpickr flatpickr-date");
        let mehsulPublishDateLabel = createLabel("form-label", mehsulPublishDateID, "Yayınlanma Tarixi");
        let mehsulPublishDateInput = createInput("form-control", mehsulPublishDateID, "off", "Yayınlanma Tarixi Seçə Bilərsiniz.", mehsulPublishDateNameAttr, ['data-input', '']);
        let mehsulPublishDateSpan = createSpan('input-group-text input-group-addon', '', ['data-toggle', '']);
        let mehsulPublishDateIElement = createIElement('', ['data-feather', 'calendar']);
        mehsulPublishDateDiv.appendChild(mehsulPublishDateLabel);
        mehsulPublishDateSpan.appendChild(mehsulPublishDateIElement);
        mehsulPublishDateDiv2.appendChild(mehsulPublishDateInput);
        mehsulPublishDateDiv2.appendChild(mehsulPublishDateSpan);
        mehsulPublishDateDiv.appendChild(mehsulPublishDateDiv2);

        let mehsulPStatusID = 'p_status-' + variantCount;
        let mehsulPStatusNameAttr = 'variant[' + variantCount + '][p_status]';
        let mehsulPStatusDiv = createDiv("col-md-6  mb-4")
        let mehsulPStatusLabel = createLabel("form-check-label", mehsulPStatusID, "Aktiv olsun?");
        let mehsulPStatusInput = createInput("form-check-input", mehsulPStatusID, "", "", mehsulPStatusNameAttr, null, 'checkbox');
        mehsulPStatusDiv.appendChild(mehsulPStatusInput);
        mehsulPStatusDiv.appendChild(mehsulPStatusLabel);

        let mehsulAddSizeDiv = createDiv("row");
        let mehsulAddSizeSpan = createSpan('ms-2', 'Ölçü Əlavə Et', null);
        let mehsulAddSizeIElement = createIElement('add-size', ['data-feather', 'plus-circle']);
        let mehsulAddSizeAElement = createAElement(null, 'btn-add-size col-md-12', 'javascript:void(0)', ['data-variant-id', variantCount]);

        let mehsulAddSizeIElementImage = createIElement('add-size', ['data-feather', 'image']);
        let mehsulAddSizeAElementImageSetAttribute = [];
        mehsulAddSizeAElementImageSetAttribute.push({'data-variant-id' : variantCount});
        let dataInputAttr = ("data-input-" + variantCount);
        let dataPreviewAttr = ("data-preview-" + variantCount);
        mehsulAddSizeAElementImageSetAttribute.push({'data-input' : dataInputAttr});
        mehsulAddSizeAElementImageSetAttribute.push({'data-preview' : dataPreviewAttr});
        mehsulAddSizeAElementImageSetAttribute.push({'data-variant-id' : variantCount});

        let imageDataInputElementNameAttr = 'image[' + variantCount + '][]';
        let imageDataInputElement = createInput("form-control", dataInputAttr, 'off', '', imageDataInputElementNameAttr,null)
        let imageDataPreviewElement = createDiv('col-md-12', dataPreviewAttr);

        let mehsulAddSizeAElementImage = createAElement(null, 'btn btn-info btn-add-image mb-4', 'javascript:void(0)', mehsulAddSizeAElementImageSetAttribute,  'Şəkil Əlavə Et ');
        let mehsulAddSizeAElementDiv = createDiv("col-md-12");
        mehsulAddSizeAElementImage.appendChild(mehsulAddSizeIElementImage);
        mehsulAddSizeAElementDiv.appendChild(mehsulAddSizeAElementImage);

        mehsulAddSizeAElement.appendChild(mehsulAddSizeIElement);
        mehsulAddSizeAElement.appendChild(mehsulAddSizeSpan);

        mehsulAddSizeDiv.appendChild(mehsulAddSizeAElementDiv);
        mehsulAddSizeDiv.appendChild(imageDataInputElement);
        mehsulAddSizeDiv.appendChild(imageDataPreviewElement);
        mehsulAddSizeDiv.appendChild(mehsulAddSizeAElement);

        let mehsulAddSizeGeneralDiv = createDiv("col-md-12 p-0 mb-3", sizeDivKey + variantCount);


        let hr2 = document.createElement("hr");
        hr2.className = "my-2";
        variantDeleteDiv.appendChild(variantDeleteAElement);
        variantDeleteDiv.appendChild(hr2);

        row2.appendChild(variantDeleteDiv);

        row.appendChild(row2);

        row.appendChild(mehsulAdiDiv);
        row.appendChild(mehsulVariantNameDiv);
        row.appendChild(mehsulSlugDiv);
        row.appendChild(mehsulAdditionalPriceDiv);
        row.appendChild(mehsulFinalPriceDiv);
        row.appendChild(mehsulExtraDescriptionDiv);
        row.appendChild(mehsulPublishDateDiv);
        row.appendChild(mehsulPStatusDiv);
        row.appendChild(mehsulAddSizeDiv);
        row.appendChild(mehsulAddSizeGeneralDiv);

        let hr = document.createElement("hr");
        hr.className = "my-5";
        row.appendChild(hr);


        // variants.insertAdjacentElement('beforebegin', row2);
        // variants.insertAdjacentElement('beforebegin', hr2);
        variants.insertAdjacentElement('afterbegin', row);

        variantCount++;

        feather.replace();
        flatpickr(".flatpickr-date", {
            wrap      : true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
    });

    typeID.addEventListener('change', function ()
    {
        for (let i=0; i <=variantCount; i++)
        {
            let findDiv = document.querySelector('#' + sizeDivKey + i );
            if (findDiv)
            {
                findDiv.innerHTML = "";
            }
        }
    });

    document.body.addEventListener('click', function (event)
    {
        let element = event.target;

        if (element.classList.contains('btn-delete-variant'))
        {
            let variantID = element.getAttribute("data-variant-id");
            let findDeleteVariantElement = document.querySelector('#row-' + variantID);
            if (findDeleteVariantElement)
            {
                findDeleteVariantElement.remove();
                updateVariantIndexes();
            }
        }

        if (element.classList.contains('btn-size-stock-delete'))
        {
            let dataSizeStockID = element.getAttribute('data-size-stock-id');
            let findSizeStockDiv = document.querySelector("#sizeStockDeleteGeneral-" + dataSizeStockID);
            if (findSizeStockDiv)
            {
                findSizeStockDiv.remove();
                updateSizeStockIndexes(dataSizeStockID);
            }
        }

        if (element.classList.contains('btn-add-size'))
        {
            btnAddSizeAction(element);
        }

        if (element.classList.contains('btn-add-image'))
        {
            var options = {
                filebrowserImageBrowseUrl: '/admin/ecommerce-filemanager?type=Images',
                filebrowserImageUploadUrl: '/admin/ecommerce-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl     : '/admin/ecommerce-filemanager?type=Files',
                filebrowserUploadUrl     : '/admin/gecommercedg-filemanager/upload?type=Files&_token=',
                type: "file"
            };

            var route_prefix = (options && options.prefix) ? options.prefix : '/admin/ecommerce-filemanager';

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
                target_preview.innerHtml = '';

                // set or change the preview image src
                items.forEach(function (item)
                {
                    let radio = document.createElement('input');
                    radio.type = "radio";
                    radio.setAttribute('name', 'variant[' + variantID + '][image]');
                    radio.setAttribute('value', item.url);

                    let img = document.createElement('img')
                    img.setAttribute('style', 'height: 5rem')
                    img.setAttribute('src', item.thumb_url)
                    target_preview.appendChild(radio);
                    target_preview.appendChild(img);
                });

                // trigger change event
                target_preview.dispatchEvent(new Event('change'));
            }
        }

        if (element.parentElement.classList.contains('btn-add-size'))
        {
            btnAddSizeAction(element.parentElement);
        }
    })

    document.body.addEventListener('input', function (event){

        let element = event.target;
        let elementID = element.id;
        let requiredFieldStatus = true;

        for (const [key, properties] of Object.entries(requiredFields))
        {
            let keyElement = document.querySelector('#' + key);
            let keylementValue = keyElement.value;

            if (properties.type === 'input')
            {
                if (keylementValue.length < 2)
                {
                    requiredFieldStatus = false;

                }
                else if (properties.hasOwnProperty('data_type') && properties.data_type === 'price' && (isNaN(keylementValue) || keylementValue < 0))
                {
                    requiredFieldStatus = false;
                }
            }
            else if (properties.type === 'select' && keylementValue === '-1')
            {
                requiredFieldStatus = false;
            }
        }


        if (requiredFieldStatus)
        {
            productVariantTab.removeAttribute('disabled');
        }
        else
        {
            productVariantTab.setAttribute('disabled', '');
        }

    });

    function shoesNumberGenerate()
    {
        let numbers = [];
        for (let i = 20; i < 51; i++)
        {
            numbers.push(i);
        }
        return numbers;
    }

    function updateVariantIndexes()
    {
        let allVariants = document.querySelectorAll('.row.variant');
        allVariants = Array.from(allVariants).reverse();
        allVariants.forEach((variant, index) => {
            variant.id = "row-" + index;

            variant.querySelectorAll('[data-variant-id]').forEach(element => {
                element.setAttribute('data-variant-id', index);
            });

            variant.querySelectorAll('[for^="name-"]').forEach(element => {
                element.setAttribute('for', ("name-" + index));
            });

            variant.querySelectorAll('[id^="name-"]').forEach(element => {
                element.id = "name-" + index;
                element.setAttribute("name", "variant[" + index + "][name]")
            });

            variant.querySelectorAll('[for^="variant_name-"]').forEach(element => {
                element.setAttribute('for', ("variant_name-" + index));
            });

            variant.querySelectorAll('[id^="variant_name-"]').forEach(element => {
                element.id = "variant_name-" + index;
                element.setAttribute("name", "variant[" + index + "][variant_name]")
            });

            variant.querySelectorAll('[for^="slug-"]').forEach(element => {
                element.setAttribute('for', ("slug-" + index));
            });

            variant.querySelectorAll('[id^="slug-"]').forEach(element => {
                element.id = "slug-" + index;
                element.setAttribute("name", "variant[" + index + "][slug]")
            });

            variant.querySelectorAll('[for^="additional_price-"]').forEach(element => {
                element.setAttribute('for', ("additional_price-" + index));
            });

            variant.querySelectorAll('[id^="additional_price-"]').forEach(element => {
                element.id = "additional_price-" + index;
                element.setAttribute("name", "variant[" + index + "][additional_price]")
            });

            variant.querySelectorAll('[for^="final_price-"]').forEach(element => {
                element.setAttribute('for', ("final_price-" + index));
            });

            variant.querySelectorAll('[id^="final_price-"]').forEach(element => {
                element.id = "final_price-" + index;
                element.setAttribute("name", "variant[" + index + "][final_price]")
            });

            variant.querySelectorAll('[for^="extra_description-"]').forEach(element => {
                element.setAttribute('for', ("extra_description-" + index));
            });

            variant.querySelectorAll('[id^="extra_description-"]').forEach(element => {
                element.id = "extra_description-" + index;
                element.setAttribute("name", "variant[" + index + "][extra_description]")
            });

            variant.querySelectorAll('[for^="publish_date-"]').forEach(element => {
                element.setAttribute('for', ("publish_date-" + index));
            });

            variant.querySelectorAll('[id^="publish_date-"]').forEach(element => {
                element.id = "publish_date-" + index;
                element.setAttribute("name", "variant[" + index + "][publish_date]")
            });

            variant.querySelectorAll('[for^="p_status-"]').forEach(element => {
                element.setAttribute('for', ("p_status-" + index));
            });

            variant.querySelectorAll('[id^="p_status-"]').forEach(element => {
                element.id = "p_status-" + index;
                element.setAttribute("name", "variant[" + index + "][p_status]")
            });

            variant.querySelectorAll('[for^="size-"]').forEach(element => {
                element.setAttribute('for', ("size-" + index));
            });

            variant.querySelectorAll('[id^="size-"]').forEach(element => {
                element.id = "size-" + index;
                element.setAttribute("name", "variant[" + index + "][size]")
            });

            variant.querySelectorAll('[for^="stock-"]').forEach(element => {
                element.setAttribute('for', ("stock-" + index));
            });

            variant.querySelectorAll('[id^="stock-"]').forEach(element => {
                element.id = "stock-" + index;
                element.setAttribute("name", "variant[" + index + "][stock]")
            });

        });
        variantCount--;
    }


    function btnAddSizeAction(element)
    {
        let dataVariantID = element.getAttribute("data-variant-id");

        let sizeStock= 0;
        if (variantSizeStockInfo.hasOwnProperty(dataVariantID))
        {
            sizeStock = variantSizeStockInfo[dataVariantID]['size_stock'];
        }

        let productTypeID = typeID.value;
        let productSize = sizes[productTypeID];
        let options = ["Ölçü Seçə Bilərsiniz"];
        options = options.concat(productSize);
        let divID = sizeDivKey + dataVariantID;
        let findDiv = document.querySelector("#" + divID);

        let mehsulSizeID = 'size-' + dataVariantID + '-' + sizeStock;
        let mehsulSizeNameAttr = 'variant[' + dataVariantID + '][size][' + sizeStock + ']';
        let mehsulSizeDiv = createDiv("col-md-5 mb-4 px-3")
        let mehsulSizeLabel = createLabel("form-label", mehsulSizeID, "Bədən Ölçüsü");

        let mehsulSizeSelect = createSelect("form-control", mehsulSizeID, mehsulSizeNameAttr, null,options);

        mehsulSizeDiv.appendChild(mehsulSizeLabel);
        mehsulSizeDiv.appendChild(mehsulSizeSelect);

        let mehsulStockID = 'stock-' + dataVariantID + '-' + sizeStock;
        let mehsulStockNameAttr = 'variant[' + dataVariantID + '][stock][' + sizeStock + ']';
        let mehsulStockDiv = createDiv("col-md-5 mb-4 px-3")
        let mehsulStockLabel = createLabel("form-label", mehsulStockID, "Stok Sayı");
        let mehsulStockInput = createInput("form-control", mehsulStockID, "off", "Stok Sayı", mehsulStockNameAttr);

        mehsulStockDiv.appendChild(mehsulStockLabel);
        mehsulStockDiv.appendChild(mehsulStockInput);

        let generalDivID = "sizeStockDeleteGeneral-" + dataVariantID + "-" + sizeStock;
        let mehsulSizeStockGeneralDivClass = "row mx-0 size-stock-" + dataVariantID;
        let mehsulSizeStockGeneralDiv = createDiv(mehsulSizeStockGeneralDivClass, generalDivID)

        let mehsulSizeStockDeleteDiv = createDiv("col-md-2 mb-4 px-3")
        let aElementID = "sizeStockDelete-" + dataVariantID + "-" + sizeStock;
        let mehsulSizeStokDeleteAElement = createAElement(aElementID, 'btn btn-danger w-100 btn-size-stock-delete', 'javascript:void(0)', ['data-size-stock-id', dataVariantID + '-' + sizeStock], 'Beden Sil' );
        let mehsulSizeStokDeleteAElementLabel = createLabel("form-label d-block", "", "",'&nbsp;');

        mehsulSizeStockDeleteDiv.appendChild(mehsulSizeStokDeleteAElementLabel);
        mehsulSizeStockDeleteDiv.appendChild(mehsulSizeStokDeleteAElement);

        mehsulSizeStockGeneralDiv.appendChild(mehsulSizeDiv);
        mehsulSizeStockGeneralDiv.appendChild(mehsulStockDiv);
        mehsulSizeStockGeneralDiv.appendChild(mehsulSizeStockDeleteDiv);


        findDiv.appendChild(mehsulSizeStockGeneralDiv);


        if (variantSizeStockInfo.hasOwnProperty(dataVariantID))
        {
            variantSizeStockInfo[dataVariantID]['size_stock'] = (Number)(variantSizeStockInfo[dataVariantID]['size_stock']) + 1
        }
        else
        {
            variantSizeStockInfo[dataVariantID]= {
                'size_stock': 1
            };
        }
    }


    function createDiv(className, id = null)
    {
        let div = document.createElement('div');
        div.className = className;
        if (id != null)
        {
            div.id = id;
        }
        return div;
    }
    function createLabel(className, forAttr, textContent = null, innerHtml = null)
    {
        let label = document.createElement('label');
        label.className = className;
        label.textContent = textContent;
        if (innerHtml)
        {
            label.innerHTML = innerHtml;
        }
        label.setAttribute('for', forAttr);

        return label;
    }
    function createSpan(className, textContent = null, setAttribute = null)
    {
        let label = document.createElement('span');
        label.className = className;
        if (textContent != null)
        {
            label.textContent = textContent;
        }
        if (setAttribute != null)
        {
            label.setAttribute(setAttribute[0], setAttribute[1]);
        }
        return label;
    }
    function createIElement(className, setAttribute = null)
    {
        let label = document.createElement('i');
        label.className = className;
        if (setAttribute != null)
        {
            label.setAttribute(setAttribute[0], setAttribute[1]);
        }
        return label;
    }
    function createInput(className, id, autocomplete, placeholder, nameAttr, setAttribute = null, type = 'text')
    {
        let input = document.createElement('input');
        input.type = type;
        input.className = className;
        input.id=id;
        input.autocomplete = autocomplete
        input.placeholder= placeholder;
        input.setAttribute('name', nameAttr);

        if (setAttribute != null)
        {
            input.setAttribute(setAttribute[0], setAttribute[1])
        }

        return input;
    }
    function createSelect(className = null, id = null, nameAttr = null, setAttribute = null, options = null )
    {
        let select = document.createElement('select');
        select.className = className;
        if (id != null)
        {
            select.id=id;
        }
        select.setAttribute('name', nameAttr);

        if (setAttribute != null)
        {
            select.setAttribute(setAttribute[0], setAttribute[1])
        }

        if (options != null && Array.isArray(options))
        {
            options.forEach(function (item, index, array)
            {
                if (select.options.length < 1)
                {
                    select.options[select.options.length] = new Option( item, "-1");
                }
                else
                {
                    select.options[select.options.length] = new Option(item);
                }
            })
        }


        return select;
    }
    function createAElement(id = null, className = null, href = null, setAttribute = null, textContent = null)
    {
        let aElement = document.createElement('a');
        if (className != null)
        {
            aElement.className = className;
        }

        if (id != null)
        {
            aElement.id = id;
        }

        if (setAttribute != null)
        {
            if (Array.isArray(setAttribute) && setAttribute.length > 2)
            {
                setAttribute.forEach(function (item, index)
                {
                    let keys = Object.keys(item);
                    keys.forEach(function (key)
                    {
                        aElement.setAttribute(key, item[key])
                    })
                })
            }
            else
            {
                aElement.setAttribute(setAttribute[0], setAttribute[1])
            }
        }
        aElement.textContent = textContent;

        return aElement;
    }

    function updateSizeStockIndexes(dataSizeStockID)
    {
        dataSizeStockID = dataSizeStockID.split("-");
        let variantID = dataSizeStockID[0];
        let sizeStockID = dataSizeStockID[1];

        let allSizeStock = document.querySelectorAll('.row.size-stock-' + variantID);
        allSizeStock.forEach((variant, index) =>
        {
            let id = variantID + "-" + index;
            variant.id = "sizeStockDeleteGeneral-" + id;

            variant.querySelectorAll('[for^="size-"]').forEach(element => {
                element.setAttribute('for',("size-" + id));
            });
            variant.querySelectorAll('[id^="size-"]').forEach(element => {
                element.id = "size-" + id;
                element.setAttribute("name", "variant[" + variantID + "][size][" + index +"]")
            });

            variant.querySelectorAll('[for^="stock-"]').forEach(element => {
                element.setAttribute('for',("stock-" + id));
            });
            variant.querySelectorAll('[id^="stock-"]').forEach(element => {
                element.id = "stock-" + id;
                element.setAttribute("name", "variant[" + variantID + "][stock][" + index +"]")
            });

            variant.querySelectorAll('[id^="sizeStockDelete-"]').forEach(element => {
                element.id = "sizeStockDelete-" + id;
                element.setAttribute("data-size-stock-id", id);
            });






        });

        let sizeStock = --variantSizeStockInfo[variantID]['size_stock'];
        variantSizeStockInfo[variantID]['size_stock'] = sizeStock;
    }
});
