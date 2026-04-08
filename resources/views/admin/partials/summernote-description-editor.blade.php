@push('scripts')
    <style>
        .note-editor .note-editable ul {
            list-style: disc;
            padding-left: 1.5rem;
        }

        .note-editor .note-editable ol {
            list-style: decimal;
            padding-left: 1.5rem;
        }

        .note-editor .note-editable[dir="rtl"] ul,
        .note-editor .note-editable[dir="rtl"] ol {
            padding-left: 0;
            padding-right: 1.5rem;
        }

        .note-modal .note-btn-primary {
            background-color: #7c2d12;
            border-color: #7c2d12;
            color: #fff;
        }

        .note-modal .note-btn-primary:hover,
        .note-modal .note-btn-primary:focus {
            background-color: #9a3412;
            border-color: #9a3412;
            color: #fff;
        }
    </style>
    <script>
        $(function () {
            function applyEditorDirection(textareaId, direction, textAlign, fontFamily) {
                const editable = $('#' + textareaId).next('.note-editor').find('.note-editable');

                editable.attr('dir', direction).css({
                    direction: direction,
                    'text-align': textAlign,
                    'font-family': fontFamily
                });
            }

            const sharedConfig = {
                height: 320,
                minHeight: 220,
                placeholder: '',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'table']],
                    ['view', ['codeview']]
                ]
            };

            $('#description_en').summernote({
                ...sharedConfig,
                dialogsInBody: true,
                callbacks: {
                    onInit: function () {
                        applyEditorDirection('description_en', 'ltr', 'left', 'PT Serif, serif');
                    },
                    onFocus: function () {
                        applyEditorDirection('description_en', 'ltr', 'left', 'PT Serif, serif');
                    }
                }
            });

            $('#description_ar').summernote({
                ...sharedConfig,
                dialogsInBody: true,
                callbacks: {
                    onInit: function () {
                        applyEditorDirection('description_ar', 'rtl', 'right', 'Amiri, serif');
                    },
                    onFocus: function () {
                        applyEditorDirection('description_ar', 'rtl', 'right', 'Amiri, serif');
                    }
                }
            });
        });
    </script>
@endpush
