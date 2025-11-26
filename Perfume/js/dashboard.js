// dashboard.js
document.addEventListener('DOMContentLoaded', ()=> {
  const tabs = document.querySelectorAll('#sideMenu a');
  const panes = document.querySelectorAll('.tab-pane');

  tabs.forEach(t => {
    t.addEventListener('click', (e)=>{
      e.preventDefault();
      tabs.forEach(x => x.classList.remove('active'));
      t.classList.add('active');
      let to = t.dataset.tab;
      panes.forEach(p => {
        if(p.id === to){ p.classList.remove('d-none'); p.classList.add('active'); }
        else { p.classList.add('d-none'); p.classList.remove('active'); }
      });
      // load content when switching
      if(to === 'orders') loadOrders();
      if(to === 'wishlist') loadWishlist();
      if(to === 'profile') loadProfile();
    });
  });

  // logout
  document.getElementById('logoutBtn').addEventListener('click', ()=>{
    fetch('api/logout.php').then(()=> window.location='login.php');
  });

  // profile form submit
  document.getElementById('profileForm').addEventListener('submit', async (e)=>{
    e.preventDefault();
    const form = new FormData();
    form.append('name', document.getElementById('name').value);
    form.append('phone', document.getElementById('phone').value);
    const file = document.getElementById('avatarInput').files[0];
    if(file) form.append('avatar', file);

    const res = await fetch('api/update_profile.php', { method:'POST', body: form });
    const data = await res.json();
    if(data.success) { alert('Profile updated'); loadProfile(); }
    else alert(data.error || 'Error');
  });

  // initial load
  loadProfile();
});

async function loadProfile(){
  const res = await fetch('api/get_user.php');
  const data = await res.json();
  if(data.error) { console.error(data.error); return;}
  document.getElementById('userName').innerText = data.name;
  document.getElementById('userEmail').innerText = data.email;
  document.getElementById('profileAvatar').src = data.avatar || 'images/default-avatar.png';
  document.getElementById('userAvatar').src = data.avatar || 'images/default-avatar.png';
  document.getElementById('name').value = data.name;
  document.getElementById('email').value = data.email;
  document.getElementById('phone').value = data.phone || '';
}

async function loadOrders(){
  const res = await fetch('api/get_orders.php');
  const data = await res.json();
  const container = document.getElementById('ordersList');
  if(!data.length) { container.innerHTML = '<p>No orders yet.</p>'; return; }
  let html = '<div class="list-group">';
  data.forEach(o=>{
    html += `<div class="list-group-item">
      <div class="d-flex justify-content-between">
        <div><strong>Order #${o.order_no}</strong><br><small>${o.created_at}</small></div>
        <div><span class="badge bg-secondary">${o.status}</span><br><strong>₹${o.total}</strong></div>
      </div>
    </div>`;
  });
  html += '</div>';
  container.innerHTML = html;
}

async function loadWishlist(){
  const res = await fetch('api/get_wishlist.php');
  const data = await res.json();
  const container = document.getElementById('wishlistList');
  if(!data.length){ container.innerHTML = '<p>No items in wishlist.</p>'; return; }
  let html = '<div class="row">';
  data.forEach(i=>{
    html += `<div class="col-md-6 mb-2"><div class="card p-2">
      <div class="d-flex justify-content-between">
        <div>${i.product_name}</div>
        <div><button class="btn btn-sm btn-outline-danger" onclick="removeWish(${i.id})">Remove</button></div>
      </div>
    </div></div>`;
  });
  html += '</div>';
  container.innerHTML = html;
}

async function removeWish(id){
  if(!confirm('Remove from wishlist?')) return;
  const res = await fetch('api/remove_wishlist.php',{ method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({id}) });
  const data = await res.json();
  if(data.success) loadWishlist();
  else alert('Unable to remove');
}
