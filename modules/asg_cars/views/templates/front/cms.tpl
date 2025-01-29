<div class="ourcars d-flex flex-column">
    <div class="cars-container d-flex flex-wrap">

        {foreach from=$cars item=car}
            <div class="col-3 car-container" style="margin:20px 0;">
                <p style="text-align:center;font-size:18px;padding-top:10px;"><strong>{$car.name}</strong></p>
                <div class="col-sm-12 hover_for_text"
                    style="text-align:center;padding:0;height:315px;background-size:contain;background-repeat:no-repeat;">
                    {assign var="decodedImages" value=$car['images']}
                    <img src="/{$decodedImages[0]}" width="438" alt="n_cJumper.jpg">
                    <span class=""
                        data-id="{$car.id_asg_car}"
                        style="width:100%;background-image:url(/img/transparent.png);height:100%;color:#fff;"
                        onclick="openCarPage(this)">
                        See More
                    </span>
                </div>
            </div>
        {/foreach}

    </div>
</div>
<style>
.cms-id-28 .ourcars .cars-container .car-container .hover_for_text > span{
    display: none;
  position: absolute;
  top: 0;
  left: 0;
  font-size: 2rem;
  font-weight: 600;
  backdrop-filter: blur(10px);
}

.cars-container .car-container:hover .hover_for_text > span {
    display: flex !important;
    justify-content: center;
    align-items: center;
}
</style>

<script>
function openCarPage(e){
    const idcar = e.getAttribute("data-id")
    window.location.href = `/index.php?fc=module&module=asg_cars&controller=FrontAsgCars&id_car=`+idcar;
    // window.location.href = url;
}
</script>