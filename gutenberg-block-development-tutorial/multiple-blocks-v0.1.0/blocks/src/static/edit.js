/**
 * External dependencies
 */
import classnames from 'classnames';

import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	RichText,
	AlignmentControl,
	BlockControls,
	InspectorControls,
} from '@wordpress/block-editor';

import {
	TextControl,
	ToggleControl,
	PanelBody,
	PanelRow,
	SelectControl,
} from '@wordpress/components';

import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( {
		className: 'wz-alert',
	} );
	const { content, align, showHeading, heading, iconName } = attributes;

	const onChangeContent = ( newContent ) => {
		setAttributes( { content: newContent } );
	};

	const onChangeHeading = ( newHeading ) => {
		setAttributes( { heading: newHeading } );
	};

	const onChangeIconName = ( newIconName ) => {
		setAttributes( { iconName: newIconName } );
	};

	const toggleHeading = () => {
		setAttributes( { showHeading: ! showHeading } );
	};

	const onChangeAlign = ( newAlign ) => {
		setAttributes( {
			align: newAlign === undefined ? 'none' : newAlign,
		} );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody
					title={ __( 'Settings', 'basic-block' ) }
					initialOpen={ true }
				>
					<PanelRow>
						<fieldset>
							<ToggleControl
								label={ __(
									'Show an heading before',
									'basic-block'
								) }
								help={
									showHeading
										? __(
												'Heading displayed',
												'basic-block'
										  )
										: __(
												'No Heading displayed',
												'basic-block'
										  )
								}
								checked={ showHeading }
								onChange={ toggleHeading }
							/>
						</fieldset>
					</PanelRow>
					{ showHeading && (
						<>
							<PanelRow>
								<fieldset>
									<TextControl
										label={ __( 'Heading', 'basic-block' ) }
										value={ heading }
										onChange={ onChangeHeading }
										help={ __(
											'Text to display above the alert box',
											'basic-block'
										) }
									/>
								</fieldset>
							</PanelRow>
							<PanelRow>
								<fieldset>
									<SelectControl
										label={ __(
											'Select an icon',
											'basic-block'
										) }
										value={ iconName }
										onChange={ onChangeIconName }
										help={ __(
											'Icon that is displayed before the heading text',
											'basic-block'
										) }
										options={ [
											{
												value: 'none',
												label: __(
													'Select an Icon',
													'basic-block'
												),
											},
											{
												value: 'format-quote',
												label: __(
													'Quote',
													'basic-block'
												),
											},
											{
												value: 'info-outline',
												label: __(
													'Info',
													'basic-block'
												),
											},
											{
												value: 'warning',
												label: __(
													'Warning',
													'basic-block'
												),
											},
										] }
									/>
								</fieldset>
							</PanelRow>
						</>
					) }
				</PanelBody>
			</InspectorControls>

			<BlockControls group="block">
				<AlignmentControl value={ align } onChange={ onChangeAlign } />
			</BlockControls>

			<div { ...blockProps }>
				{ showHeading && (
					<div className="wz-alert-heading">
						{ iconName !== 'none' && (
							<span
								className={ classnames( 'dashicons', {
									[ `dashicons-${ iconName }` ]:
										iconName !== 'none',
								} ) }
							></span>
						) }
						<strong>{ heading }</strong>
					</div>
				) }

				<RichText
					tagName="div"
					value={ content }
					onChange={ onChangeContent }
					placeholder={ __(
						'Enter the alert text...',
						'basic-block'
					) }
					style={ { textAlign: align } }
					className="wz-alert-text"
				/>
			</div>
		</>
	);
}
