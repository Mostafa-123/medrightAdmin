  $(document).ready(function() {
    $('#example').DataTable({
      "language": {
        "paginate": {
          "previous": "السابق",
          "next": "التالي"
        }
      }
    });

    
    // Change the placeholder of the search input
    var searchInput = $('.dataTables_wrapper input[type="search"]');
    searchInput.attr("placeholder", "بحث");
  
    // Find the label and update the text
    var searchLabel = $('.dataTables_wrapper #example_filter label');
    console.log(searchLabel.contents().nodeType);
    searchLabel.contents().filter(function() {
      console.log(this);
      return this.nodeType === 3; // Filter out non-text nodes
    }).first().replaceWith("بحث: ");
  });