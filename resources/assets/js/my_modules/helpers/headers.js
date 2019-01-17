/**
 * the 'applicationHeaders' are required to be a header in all the
 * POST ~ DELETE ~ PUT ~ UPDATE 
 * requests ! 
 */
let token = document.head.querySelector('meta[name="csrf-token"]');
const applicationHeaders = new Headers({
  'X-CSRF-TOKEN': token.content,
  'Content-Type': 'application/json',
});

export {
  applicationHeaders
};
