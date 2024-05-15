document.addEventListener("DOMContentLoaded", function ()
{
    let addVariant = document.querySelector('#addVariant');
    let variants = document.querySelector('#variants');
    let variantCount = 0;

    addVariant.addEventListener('click', function ()
    {
        let row = createDiv("row")

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
        let mehsulVariantNameLabel = createLabel("form-label", mehsulVariantNameID, "Məhsul Variantının Adı");
        let mehsulVariantNameInput = createInput("form-control", mehsulVariantNameID, "off", "Məhsul Variantının Adı", mehsulVariantNameAttr);

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
        let mehsulExtraDescriptionLabel = createLabel("form-label", mehsulExtraDescriptionID, "Əlavə Açıqlama");
        let mehsulExtraDescriptionInput = createInput("form-control", mehsulExtraDescriptionID, "off", "Əlavə Açıqlama", mehsulExtraDescriptionNameAttr);

        mehsulExtraDescriptionDiv.appendChild(mehsulExtraDescriptionLabel);
        mehsulExtraDescriptionDiv.appendChild(mehsulExtraDescriptionInput);


        let mehsulPublishDateID = 'publish_date-' + variantCount;
        let mehsulPublishDateNameAttr = 'variant[' + variantCount + '][publish_date]';
        let mehsulPublishDateDiv = createDiv("col-md-12 mb-4");
        let mehsulPublishDateDiv2 = createDiv("input-group flatpickr flatpickr-date");
        let mehsulPublishDateLabel = createLabel("form-label", mehsulPublishDateID, "Yayınlanma Tarixi");
        let mehsulPublishDateInput = createInput("form-control", mehsulPublishDateID, "off", "Yayınlanma Tarixini Seçə bilərsiniz.", mehsulPublishDateNameAttr, ['data-input', '']);
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

        let mehsulAddSizeDiv = createDiv("");
        let mehsulAddSizeSpan = createSpan('ms-2', 'Ölçü Əlavə Edin', null);
        let mehsulAddSizeIElement = createIElement('add-size', ['data-feather', 'plus-circle']);

        mehsulAddSizeDiv.appendChild(mehsulAddSizeIElement);
        mehsulAddSizeDiv.appendChild(mehsulAddSizeSpan);

        row.appendChild(mehsulAdiDiv);
        row.appendChild(mehsulVariantNameDiv);
        row.appendChild(mehsulSlugDiv);
        row.appendChild(mehsulAdditionalPriceDiv);
        row.appendChild(mehsulFinalPriceDiv);
        row.appendChild(mehsulExtraDescriptionDiv);
        row.appendChild(mehsulPublishDateDiv);
        row.appendChild(mehsulPStatusDiv);
        row.appendChild(mehsulAddSizeDiv);

        let hr = document.createElement("hr");
        hr.className = "my-5";
        row.appendChild(hr);

        variants.insertAdjacentElement('afterbegin', row);

        variantCount++;

        feather.replace();

    });

    function createDiv(className)
    {
        let div = document.createElement('div');
        div.className = className;
        return div;
    }

    function createLabel(className, forAttr, textContent)
    {
        let label = document.createElement('label');
        label.className = className;
        label.textContent = textContent;
        label.setAttribute('for', forAttr);

        return label;
    }

    function createSpan(className, textContent = null, setAttribute = null)
    {
        let span = document.createElement('span');
        span.className = className;
        if (textContent != null)
        {
            span.textContent = textContent;
        }
        if (setAttribute != null)
        {
            span.setAttribute(setAttribute[0], setAttribute[1]);
        }
        return span;
    }

    function createIElement(className, setAttribute = null)
    {
        let i = document.createElement('i');
        i.className = className;
        if (setAttribute != null)
        {
            i.setAttribute(setAttribute[0], setAttribute[1]);
        }
        return i;
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
});
