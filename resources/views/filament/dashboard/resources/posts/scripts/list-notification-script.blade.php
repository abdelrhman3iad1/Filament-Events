<x-filament::section>
    <script>
            document.addEventListener('alpine:init', () => {
                        window.Echo.channel('posts')
                            .listen('.post-created', (e) => {
                                new FilamentNotification()
                                    .title(`New Post From ${e.author.name}`)
                                    .color('danger')
                                    .seconds(10)
                                    .body(e.content)
                                    .send();
                            });
                        }
                );
    </script>
</x-filament::section>