window.ml = cloudinary.openMediaLibraryMediaLibrary({
    cloud_name: 'dmobley0608',
    api_key: '172351854381963',
    remove_header: true,
    max_files: '1',
    insert_caption: 'Insert',
    inline_container: '#widget_container',
    default_transformations: [
      []
    ],
    button_class: 'myBtn',
    button_caption: 'Select Image or Video'
  }, {
    insertHandler: function (data) {
      data.assets.forEach(asset => { console.log("Inserted asset:",
        JSON.stringify(asset, null, 2)) })
      }
    },
    document.getElementById("open-btn")
  );  
  document.getElementById("open-btn").onclick(function(){
    console.log(window.ml)
    window.ml.show( ) 
  })
  