/*eslint no-console: */
import {
  initValidation
} from './validation';
import {
  applicationHeaders
} from '../helpers/headers';
export default function initAddPost() {
  addMoreImagesLinksButton();
  getTags();
  initHandleSubmit();
}


function addMoreImagesLinksButton() {
  const inputImages = '<div class="row"><div class="input-field col s6 animated slideInDown"><i class="material-icons prefix">image</i><input id="image2" type="url" class="validate white-text" placeholder="Image link"></div><div class="input-field col s6 animated slideInDown">          <i class="material-icons prefix">image</i>          <input id="image3" type="url" class="validate white-text" placeholder="Image link">        </div>      </div>';
  const addMoreImagesLinks = $('#addMoreImagesLinks');
  addMoreImagesLinks.click(() => {
    $('#addInputImages').html(inputImages);
    addMoreImagesLinks.remove();
  });
}


function getTags() {
  fetch('/get/tags')
    .then(res => res.json())
    .then(listOfTags => {
      const [tags, ] = listOfTags;
      setTagsAsOptions(tags);
    })
    .catch(err => console.error(err));
}


function setTagsAsOptions(tags) {
  const addOptionsHere = $('#addOptionsHere');
  let createOptions = '<select name="tag">';
  for (const key in tags)
    createOptions += `<option value="${tags[key].id}">${tags[key].name}</option>`;
  addOptionsHere.replaceWith(createOptions);
  createOptions += '</select><label>Choose a tag</label>';
  $('select').formSelect();
  initValidation();
}


function initHandleSubmit() {
  $('#submitAddPost').click(e => {
    e.preventDefault();
    let data = $('#addPostForm').serializeArray().reduce((obj, item) => {
      obj[item.name] = item.value;
      return obj;
    }, {});
    fetch('/new/post', {
        headers: applicationHeaders,
        method: 'POST',
        body: JSON.stringify(data)
      }).then(res => res.json())
      // eslint-disable-next-line no-unused-vars
      .then(res => window.location.href = `/show/post/${res[0].id}`)
      .catch(err => console.error(err));
  });
}
