<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slugInput = document.getElementById('{{ $inputId ?? 'slug' }}');
        const slugMessage = document.getElementById('{{ $messageId ?? 'slug-message' }}');
        if (!slugInput || !slugMessage) return;
        slugInput.addEventListener('input', async () => {
            const slug = slugInput.value;
            if (!slug) {
                slugMessage.textContent = '';
                return;
            }

            try {
                const response = await fetch("{{ $route }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ slug })
                });
                const data = await response.json();
                slugMessage.textContent = data.message;
                slugMessage.className = data.valid
                    ? 'text-green-600 text-sm mt-1'
                    : 'text-red-600 text-sm mt-1';

            } catch (error) {
                console.error(error);
                slugMessage.textContent = 'Error validating slug.';
                slugMessage.className = 'text-red-600 text-sm mt-1';
            }
        });
    });
</script>
