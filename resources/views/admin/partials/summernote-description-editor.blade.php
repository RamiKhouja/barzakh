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

        .note-editor .note-editable {
            overflow-x: hidden;
            overflow-y: auto;
            overflow-wrap: anywhere;
            word-break: normal;
        }

        .note-editor .note-editable[dir="rtl"] {
            direction: rtl;
            text-align: right;
            unicode-bidi: plaintext;
        }

        .note-editor .note-editable[dir="rtl"] table,
        .note-editor .note-editable[dir="rtl"] img,
        .note-editor .note-editable[dir="rtl"] iframe {
            max-width: 100%;
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

            const editors = [
                { id: 'description_en', direction: 'ltr', textAlign: 'left', fontFamily: 'PT Serif, serif' },
                { id: 'description_ar', direction: 'rtl', textAlign: 'right', fontFamily: 'Amiri, serif' }
            ];

            editors.forEach(function (editor) {
                const textarea = $('#' + editor.id);

                if (!textarea.length) {
                    return;
                }

                textarea.summernote({
                    ...sharedConfig,
                    dialogsInBody: true,
                    callbacks: {
                        onInit: function () {
                            applyEditorDirection(editor.id, editor.direction, editor.textAlign, editor.fontFamily);
                        },
                        onFocus: function () {
                            applyEditorDirection(editor.id, editor.direction, editor.textAlign, editor.fontFamily);
                        }
                    }
                });
            });
        });
    </script>
@endpush
