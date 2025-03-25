document.addEventListener("DOMContentLoaded", function () {
  // Sorting Function
  function sortTable(table, columnIndex, ascending) {
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.sort((rowA, rowB) => {
      const cellA = rowA.cells[columnIndex]?.textContent.trim();
      const cellB = rowB.cells[columnIndex]?.textContent.trim();

      const isNumeric = !isNaN(cellA) && !isNaN(cellB);

      return isNumeric
        ? ascending
          ? cellA - cellB
          : cellB - cellA
        : ascending
        ? cellA.localeCompare(cellB)
        : cellB.localeCompare(cellA);
    });

    rows.forEach((row) => tbody.appendChild(row));
  }

  // Initialize Sorting
  function initializeSorting() {
    const headers = document.querySelectorAll("th.sortable");
    if (headers.length === 0) return; // Ensure table exists

    headers.forEach((th, index) => {
      let ascending = true;
      th.addEventListener("click", () => {
        const table = th.closest("table");
        if (!table) return;
        sortTable(table, index, ascending);
        ascending = !ascending; // Toggle sorting order
      });
    });
  }

  // Search Function
  function searchTable() {
    const input = document.getElementById("searchInput");
    if (!input) return; // Ensure input exists
    const filter = input.value.toLowerCase();
    const table = document.querySelector("table");
    if (!table) return; // Ensure table exists
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
      let cells = rows[i].getElementsByTagName("td");
      let found = false;

      for (let cell of cells) {
        if (cell.textContent.toLowerCase().includes(filter)) {
          found = true;
          break;
        }
      }

      rows[i].style.display = found ? "" : "none";
    }
  }

  // Attach search function globally
  window.searchTable = searchTable;
});
