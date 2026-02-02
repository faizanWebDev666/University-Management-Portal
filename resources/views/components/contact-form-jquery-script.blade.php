   <script>
                    $(document).ready(function() {
                        $('#contactForm').on('submit', function(e) {
                            e.preventDefault(); // Prevent default form submission

                            var form = $(this);
                            var url = form.attr('action');
                            var formData = form.serialize(); // Collect all form inputs

                            // Clear previous messages
                            $('#form-messages').html('');

                            $.ajax({
                                type: "POST",
                                url: url,
                                data: formData,
                                success: function(response) {
                                    // Show success message
                                    $('#form-messages').html(
                                        `<div class="alert alert-success">
                        <ul class="mb-0">
                            <li>${response.message}</li>
                        </ul>
                    </div>`
                                    );

                                    // Reset form
                                    form[0].reset();
                                },
                                error: function(xhr) {
                                    let errors = xhr.responseJSON.errors;
                                    let errorHtml = '<div class="alert alert-danger"><ul class="mb-0">';
                                    $.each(errors, function(key, value) {
                                        errorHtml += `<li>${value[0]}</li>`;
                                    });
                                    errorHtml += '</ul></div>';
                                    $('#form-messages').html(errorHtml);
                                }
                            });
                        });
                    });
                </script>