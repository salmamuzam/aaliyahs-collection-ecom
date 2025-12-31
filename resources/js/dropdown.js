document.addEventListener('livewire:navigated', () => {
        let dropdownToggle = document.getElementById('dropdownToggle');
        let dropdownMenu = document.getElementById('dropdownMenu');

        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
            dropdownMenu.classList.toggle('block');
        }

        function hideDropdown() {
            dropdownMenu.classList.add('hidden');
            dropdownMenu.classList.remove('block');
        }

        dropdownToggle.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevents triggering document click
            toggleDropdown();
        });

        // Hide dropdown when <li> is clicked
        dropdownMenu.querySelectorAll('.dropdown-item').forEach((li) => {
            li.addEventListener('click', () => {
                hideDropdown();
            });
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', (event) => {
            if (!dropdownMenu.contains(event.target) && event.target !== dropdownToggle) {
                hideDropdown();
            }
        });
    });
