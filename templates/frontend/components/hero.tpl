    {if $homepageImage}
		<div class="heroContainer">
			<img class="heroImage" src="{$publicFilesDir}/{$homepageImage.uploadName|escape:"url"}" alt="Hero Image">
            <p class="heroClaim">{$homepageImage.altText|escape}</p>
		</div>
	{/if}
