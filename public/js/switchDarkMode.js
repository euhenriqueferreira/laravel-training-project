const toggleButton = document.getElementById('theme-toggle');

document.addEventListener('DOMContentLoaded', () => {
    const htmlElement = document.documentElement;
    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.className = savedTheme;

    setTheme(savedTheme);

    // Alterna o tema ao clicar no botão
    toggleButton.addEventListener('click', () => {
        const currentTheme = htmlElement.className === 'dark' ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        htmlElement.className = newTheme;
        localStorage.setItem('theme', newTheme);

        setTheme(newTheme);
    });
});


function setTheme(currentTheme) {
    const isLight = currentTheme === 'light';
    toggleButton.querySelector('#light').classList.toggle('hidden', !isLight);
    toggleButton.querySelector('#dark').classList.toggle('hidden', isLight);
}