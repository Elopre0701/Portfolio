// Function to handle CV download
function downloadCv() {
    // Specify the path to the CV file
    const cvUrl = 'Elopre.pdf';

    // Create a temporary link element
    const link = document.createElement('a');
    link.href = cvUrl;

    // Set the download attribute with a default file name
    link.download = 'ElopreJhonResume.pdf';

    // Append the link to the body
    document.body.appendChild(link);

    // Programmatically click the link to trigger the download
    link.click();

    // Remove the link from the document
    document.body.removeChild(link);
}

// Attach event listener to all buttons with the class 'downloadCvButton'
document.querySelectorAll('.downloadCvButton').forEach(button => {
    button.addEventListener('click', downloadCv);
});
